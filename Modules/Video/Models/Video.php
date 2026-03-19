<?php

namespace Modules\Video\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Listing\Models\Listing;
use Modules\Site\App\Support\LocalMedia;
use Modules\User\App\Models\User;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Jobs\ProcessVideo;

class Video extends Model
{
    protected $fillable = [
        'listing_id',
        'user_id',
        'title',
        'description',
        'upload_disk',
        'upload_path',
        'mime_type',
        'size',
        'sort_order',
        'is_active',
    ];

    protected ?string $previousUploadDisk = null;

    protected ?string $previousUploadPath = null;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'processed_at' => 'datetime',
            'status' => VideoStatus::class,
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (self $video): void {
            $video->rememberPreviousUpload();
            $video->syncListingOwner();
            $video->normalizeStatus();
        });

        static::saved(function (self $video): void {
            $video->deletePreviousUploadIfReplaced();
            $video->scheduleProcessingIfNeeded();
        });

        static::deleting(function (self $video): void {
            $video->deleteStoredFiles();
        });
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeOwnedByUser(Builder $query, int|string|null $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeReady(Builder $query): Builder
    {
        return $query->where('status', VideoStatus::Ready->value);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->whereNotNull('path');
    }

    public static function createFromTemporaryUpload(Listing $listing, TemporaryUploadedFile $file, array $attributes = []): self
    {
        $disk = (string) ($attributes['disk'] ?? config('video.disk', LocalMedia::disk()));
        $path = $file->storeAs(
            trim((string) config('video.upload_directory', 'videos/uploads').'/'.$listing->getKey(), '/'),
            Str::ulid().'.'.($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'mp4'),
            $disk,
        );

        return static::query()->create([
            'listing_id' => $listing->getKey(),
            'user_id' => $listing->user_id,
            'title' => trim((string) ($attributes['title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))),
            'description' => $attributes['description'] ?? null,
            'upload_disk' => $disk,
            'upload_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'sort_order' => (int) ($attributes['sort_order'] ?? static::nextSortOrderForListing($listing)),
            'is_active' => (bool) ($attributes['is_active'] ?? true),
        ]);
    }

    public static function createFromUploadedFile(Listing $listing, UploadedFile $file, array $attributes = []): self
    {
        $disk = (string) ($attributes['disk'] ?? config('video.disk', LocalMedia::disk()));
        $path = $file->storeAs(
            trim((string) config('video.upload_directory', 'videos/uploads').'/'.$listing->getKey(), '/'),
            Str::ulid().'.'.($file->getClientOriginalExtension() ?: $file->extension() ?: 'mp4'),
            $disk,
        );

        return static::query()->create([
            'listing_id' => $listing->getKey(),
            'user_id' => $listing->user_id,
            'title' => trim((string) ($attributes['title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))),
            'description' => $attributes['description'] ?? null,
            'upload_disk' => $disk,
            'upload_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'sort_order' => (int) ($attributes['sort_order'] ?? static::nextSortOrderForListing($listing)),
            'is_active' => (bool) ($attributes['is_active'] ?? true),
        ]);
    }

    public static function nextSortOrderForListing(Listing $listing): int
    {
        return ((int) $listing->videos()->max('sort_order')) + 1;
    }

    public static function panelIndexDataForUser(User $user): array
    {
        return [
            'videos' => static::query()
                ->ownedByUser($user->getKey())
                ->with('listing:id,title,user_id')
                ->latest('id')
                ->paginate(10)
                ->withQueryString(),
            'listingOptions' => $user->panelListingOptions(),
        ];
    }

    public function markAsProcessing(): void
    {
        if (blank($this->upload_path)) {
            return;
        }

        $this->forceFill([
            'status' => VideoStatus::Processing,
            'processing_error' => null,
        ])->saveQuietly();
    }

    public function markAsProcessed(array $attributes): void
    {
        $previousDisk = $this->disk;
        $previousPath = $this->path;
        $uploadDisk = $this->upload_disk;
        $uploadPath = $this->upload_path;

        $this->forceFill([
            'disk' => $attributes['disk'] ?? (string) config('video.disk', LocalMedia::disk()),
            'path' => $attributes['path'] ?? null,
            'upload_disk' => (string) config('video.disk', LocalMedia::disk()),
            'upload_path' => null,
            'mime_type' => $attributes['mime_type'] ?? 'video/mp4',
            'size' => $attributes['size'] ?? null,
            'duration_seconds' => $attributes['duration_seconds'] ?? null,
            'width' => $attributes['width'] ?? null,
            'height' => $attributes['height'] ?? null,
            'status' => VideoStatus::Ready,
            'processing_error' => null,
            'processed_at' => now(),
        ])->saveQuietly();

        if ($previousPath !== $this->path) {
            $this->deleteStoredFile($previousDisk, $previousPath);
        }

        if ($uploadPath !== $this->path) {
            $this->deleteStoredFile($uploadDisk, $uploadPath);
        }
    }

    public function markAsFailed(string $message): void
    {
        $this->forceFill([
            'status' => VideoStatus::Failed,
            'processing_error' => trim($message),
        ])->saveQuietly();
    }

    public function playablePath(): ?string
    {
        $status = $this->currentStatus();

        if (($status !== VideoStatus::Ready) && filled($this->upload_path)) {
            return $this->upload_path;
        }

        if (filled($this->path)) {
            return $this->path;
        }

        return $this->upload_path;
    }

    public function playableDisk(): string
    {
        $status = $this->currentStatus();

        if (($status !== VideoStatus::Ready) && filled($this->upload_path)) {
            return (string) ($this->upload_disk ?: config('video.disk', LocalMedia::disk()));
        }

        if (filled($this->path)) {
            return (string) ($this->disk ?: config('video.disk', LocalMedia::disk()));
        }

        return (string) ($this->upload_disk ?: config('video.disk', LocalMedia::disk()));
    }

    public function playableUrl(): ?string
    {
        $path = $this->playablePath();

        if (blank($path)) {
            return null;
        }

        return Storage::disk($this->playableDisk())->url($path);
    }

    public function previewMimeType(): string
    {
        return (string) ($this->mime_type ?: 'video/mp4');
    }

    public function titleLabel(): string
    {
        $title = trim((string) $this->title);

        if ($title !== '') {
            return $title;
        }

        $name = trim((string) pathinfo((string) ($this->playablePath() ?? ''), PATHINFO_FILENAME));

        if ($name !== '') {
            return str($name)->after('--')->replace('-', ' ')->title()->toString();
        }

        return sprintf('Video #%d', $this->getKey());
    }

    public function statusLabel(): string
    {
        return $this->currentStatus()->label();
    }

    public function statusColor(): string
    {
        return $this->currentStatus()->color();
    }

    public function durationLabel(): string
    {
        $duration = (int) ($this->duration_seconds ?? 0);

        if ($duration < 1) {
            return '-';
        }

        return gmdate($duration >= 3600 ? 'H:i:s' : 'i:s', $duration);
    }

    public function resolutionLabel(): string
    {
        if (! $this->width || ! $this->height) {
            return '-';
        }

        return "{$this->width}x{$this->height}";
    }

    public function sizeLabel(): string
    {
        $size = (int) ($this->size ?? 0);

        if ($size < 1) {
            return '-';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = min((int) floor(log($size, 1024)), count($units) - 1);
        $value = $size / (1024 ** $power);

        return number_format($value, $power === 0 ? 0 : 1).' '.$units[$power];
    }

    public function assertOwnedBy(User $user): void
    {
        abort_unless((int) $this->user_id === (int) $user->getKey(), 403);
    }

    public function updateFromPanel(array $attributes): void
    {
        $this->forceFill([
            'listing_id' => $attributes['listing_id'] ?? $this->listing_id,
            'title' => array_key_exists('title', $attributes) ? trim((string) $attributes['title']) : $this->title,
            'description' => array_key_exists('description', $attributes) ? $attributes['description'] : $this->description,
            'is_active' => (bool) ($attributes['is_active'] ?? false),
        ])->save();

        if (($attributes['video_file'] ?? null) instanceof UploadedFile) {
            $this->replaceUploadFromUploadedFile($attributes['video_file']);
        }
    }

    public function mobileOutputPath(): string
    {
        return trim(
            (string) config('video.processed_directory', 'videos/mobile')
            .'/'.$this->listing_id
            .'/'.$this->getKey().'-'.Str::slug($this->titleLabel() ?: 'video').'.mp4',
            '/',
        );
    }

    protected function rememberPreviousUpload(): void
    {
        if (! ($this->exists && $this->isDirty('upload_path'))) {
            $this->previousUploadDisk = null;
            $this->previousUploadPath = null;

            return;
        }

        $this->previousUploadDisk = filled($this->getOriginal('upload_disk'))
            ? (string) $this->getOriginal('upload_disk')
            : (string) config('video.disk', LocalMedia::disk());

        $this->previousUploadPath = filled($this->getOriginal('upload_path'))
            ? (string) $this->getOriginal('upload_path')
            : null;
    }

    protected function syncListingOwner(): void
    {
        if (! $this->listing_id) {
            return;
        }

        $ownerId = Listing::query()
            ->whereKey($this->listing_id)
            ->value('user_id');

        if ($ownerId) {
            $this->user_id = $ownerId;
        }
    }

    protected function normalizeStatus(): void
    {
        if (blank($this->disk)) {
            $this->disk = (string) config('video.disk', LocalMedia::disk());
        }

        if (blank($this->upload_disk)) {
            $this->upload_disk = (string) config('video.disk', LocalMedia::disk());
        }

        if (! $this->isDirty('upload_path')) {
            return;
        }

        if (filled($this->upload_path)) {
            $this->status = $this->path ? VideoStatus::Processing : VideoStatus::Pending;
            $this->processing_error = null;

            return;
        }

        if (filled($this->path)) {
            $this->status = VideoStatus::Ready;
            $this->processing_error = null;
        }
    }

    protected function deletePreviousUploadIfReplaced(): void
    {
        if (
            blank($this->previousUploadPath)
            || ($this->previousUploadPath === $this->upload_path)
            || ($this->previousUploadPath === $this->path)
        ) {
            return;
        }

        $this->deleteStoredFile($this->previousUploadDisk, $this->previousUploadPath);
    }

    protected function scheduleProcessingIfNeeded(): void
    {
        if (
            blank($this->upload_path)
            || (! $this->wasRecentlyCreated)
            && (! $this->wasChanged('upload_path'))
        ) {
            return;
        }

        ProcessVideo::dispatch($this->getKey())
            ->onQueue((string) config('video.queue', 'videos'))
            ->afterCommit();
    }

    protected function deleteStoredFiles(): void
    {
        $this->deleteStoredFile($this->disk, $this->path);

        if ($this->upload_path !== $this->path) {
            $this->deleteStoredFile($this->upload_disk, $this->upload_path);
        }
    }

    protected function deleteStoredFile(?string $disk, ?string $path): void
    {
        if (blank($disk) || blank($path)) {
            return;
        }

        Storage::disk($disk)->delete($path);
    }

    protected function replaceUploadFromUploadedFile(UploadedFile $file): void
    {
        $disk = (string) config('video.disk', LocalMedia::disk());
        $path = $file->storeAs(
            trim((string) config('video.upload_directory', 'videos/uploads').'/'.$this->listing_id, '/'),
            Str::ulid().'.'.($file->getClientOriginalExtension() ?: $file->extension() ?: 'mp4'),
            $disk,
        );

        $this->forceFill([
            'upload_disk' => $disk,
            'upload_path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ])->save();
    }

    protected function currentStatus(): VideoStatus
    {
        return $this->status instanceof VideoStatus
            ? $this->status
            : (VideoStatus::tryFrom((string) $this->status) ?? VideoStatus::Pending);
    }
}
