<?php

namespace Modules\Video\Support\Filament;

use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Modules\Site\App\Support\LocalMedia;
use Modules\Video\Models\Video;

class VideoFormSchema
{
    public static function listingSection(): Section
    {
        return Section::make('Videos')
            ->description('Uploads are optimized in the browser when supported, then converted to a mobile MP4 in the queue.')
            ->schema([
                self::listingRepeater(),
            ])
            ->columnSpanFull();
    }

    public static function resourceSchema(bool $partnerScoped = false): array
    {
        return [
            Section::make('Video')
                ->schema([
                    self::listingField($partnerScoped),
                    self::titleField(),
                    self::activeField(),
                    self::descriptionField(),
                    self::uploadField(),
                    self::previewField(),
                    self::metaField(),
                ])
                ->columns(2),
        ];
    }

    public static function listingRepeater(): Repeater
    {
        return Repeater::make('videos')
            ->relationship(
                'videos',
                modifyQueryUsing: fn (Builder $query): Builder => $query->ordered(),
            )
            ->schema(self::itemSchema())
            ->defaultItems(0)
            ->addActionLabel('Add video')
            ->itemLabel(fn (array $state): string => trim((string) ($state['title'] ?? '')) ?: 'Video')
            ->maxItems((int) config('video.max_listing_videos', 5))
            ->orderColumn('sort_order')
            ->collapsible()
            ->collapsed()
            ->columns(1)
            ->mutateRelationshipDataBeforeCreateUsing(fn (array $data): array => self::normalizeData($data))
            ->mutateRelationshipDataBeforeSaveUsing(fn (array $data): array => self::normalizeData($data));
    }

    protected static function itemSchema(): array
    {
        return [
            self::titleField(),
            self::activeField(),
            self::descriptionField(),
            self::uploadField(),
            self::previewField(),
            self::metaField(),
        ];
    }

    protected static function listingField(bool $partnerScoped): Select
    {
        return Select::make('listing_id')
            ->label('Listing')
            ->relationship(
                'listing',
                'title',
                modifyQueryUsing: fn (Builder $query): Builder => $query
                    ->when(
                        $partnerScoped,
                        fn (Builder $query): Builder => $query->where('user_id', Filament::auth()->id()),
                    )
                    ->latest('id'),
            )
            ->searchable()
            ->preload()
            ->required()
            ->columnSpanFull();
    }

    protected static function titleField(): TextInput
    {
        return TextInput::make('title')
            ->maxLength(120)
            ->placeholder('Front view, walkaround, detail clip');
    }

    protected static function descriptionField(): Textarea
    {
        return Textarea::make('description')
            ->rows(3)
            ->maxLength(500)
            ->columnSpanFull();
    }

    protected static function activeField(): Toggle
    {
        return Toggle::make('is_active')
            ->label('Visible')
            ->default(true);
    }

    protected static function uploadField(): FileUpload
    {
        $clientConfig = config('video.client_side', []);

        return FileUpload::make('upload_path')
            ->label('Source video')
            ->disk(fn (): string => LocalMedia::disk())
            ->directory(trim((string) config('video.upload_directory', 'videos/uploads'), '/'))
            ->visibility('public')
            ->acceptedFileTypes([
                'video/mp4',
                'video/quicktime',
                'video/webm',
                'video/x-matroska',
                'video/x-msvideo',
            ])
            ->getUploadedFileNameForStorageUsing(
                fn (TemporaryUploadedFile $file): string => Str::ulid()
                    .'--'
                    .Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    .'.'
                    .($file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'mp4'),
            )
            ->maxSize((int) config('video.max_upload_size_kb', 102400))
            ->downloadable()
            ->openable()
            ->helperText('Browser-supported uploads are reduced before transfer. Laravel then converts them to a mobile MP4 with the queue.')
            ->required(fn (?Video $record): bool => blank($record?->path) && blank($record?->upload_path))
            ->extraInputAttributes([
                'data-video-upload-optimizer' => ($clientConfig['enabled'] ?? true) ? 'true' : 'false',
                'data-video-optimize-width' => (string) ($clientConfig['max_width'] ?? 854),
                'data-video-optimize-bitrate' => (string) ($clientConfig['bitrate'] ?? 900000),
                'data-video-optimize-fps' => (string) ($clientConfig['fps'] ?? 24),
                'data-video-optimize-min-bytes' => (string) ($clientConfig['min_size_bytes'] ?? 1048576),
            ])
            ->columnSpanFull();
    }

    protected static function previewField(): Placeholder
    {
        return Placeholder::make('preview')
            ->label('Preview')
            ->content(
                fn (?Video $record): HtmlString => new HtmlString(
                    view('video::filament.video-preview-field', ['video' => $record])->render()
                ),
            )
            ->columnSpanFull();
    }

    protected static function metaField(): Placeholder
    {
        return Placeholder::make('details')
            ->label('Details')
            ->content(function (?Video $record): string {
                if (! $record) {
                    return 'Resolution, duration, and size are filled after the queue completes.';
                }

                return collect([
                    'Status: '.$record->statusLabel(),
                    'Resolution: '.$record->resolutionLabel(),
                    'Duration: '.$record->durationLabel(),
                    'Size: '.$record->sizeLabel(),
                ])->implode(' • ');
            })
            ->columnSpanFull();
    }

    protected static function normalizeData(array $data): array
    {
        $data['upload_disk'] = (string) config('video.disk', LocalMedia::disk());

        if (blank($data['title'] ?? null) && filled($data['upload_path'] ?? null)) {
            $data['title'] = str(pathinfo((string) $data['upload_path'], PATHINFO_FILENAME))
                ->after('--')
                ->replace('-', ' ')
                ->title()
                ->toString();
        }

        return $data;
    }
}
