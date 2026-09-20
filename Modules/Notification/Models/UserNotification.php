<?php

declare(strict_types=1);

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserNotification extends Model
{
    use SoftDeletes;

    public const TYPE_OFFER = 'offer';

    public const TYPE_MESSAGE = 'message';

    public const TYPE_REVIEW = 'review';

    public const TYPE_LISTING = 'listing';

    public const TYPE_PROMOTION = 'promotion';

    public const TYPE_SAVED_SEARCH = 'saved_search';

    protected $table = 'user_notifications';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'body',
        'action_url',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    public static function publish(int $userId, string $type, string $title, ?string $body = null, ?string $actionUrl = null): self
    {
        $notification = static::query()->make([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'action_url' => $actionUrl,
        ]);

        $notification->save();

        return $notification;
    }

    public static function unreadCountForUser(int $userId): int
    {
        return (int) static::query()->forUser($userId)->unread()->count();
    }

    public static function paginateForUser(int $userId, int $perPage = 20): LengthAwarePaginator
    {
        return static::query()
            ->forUser($userId)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function latestForUser(int $userId, int $limit = 6): Collection
    {
        return static::query()
            ->forUser($userId)
            ->latest('id')
            ->limit($limit)
            ->get();
    }

    public static function markAllReadForUser(int $userId): void
    {
        static::query()
            ->forUser($userId)
            ->unread()
            ->update(['read_at' => now()]);
    }

    public function markRead(): void
    {
        if ($this->getAttribute('read_at') !== null) {
            return;
        }

        $this->forceFill(['read_at' => now()])->save();
    }

    public function isUnread(): bool
    {
        return $this->getAttribute('read_at') === null;
    }

    public function belongsToUser(int $userId): bool
    {
        return (int) $this->getAttribute('user_id') === $userId;
    }

    public function iconName(): string
    {
        return match ((string) $this->getAttribute('type')) {
            self::TYPE_OFFER => 'tag',
            self::TYPE_MESSAGE => 'mail',
            self::TYPE_REVIEW => 'star',
            self::TYPE_PROMOTION => 'sparkle',
            self::TYPE_SAVED_SEARCH => 'search',
            default => 'bell',
        };
    }
}
