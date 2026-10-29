<?php

declare(strict_types=1);

namespace App\Support;

trait FavoriteRecord
{
    public static function idsForUser(int $userId): array
    {
        return static::query()->where('user_id', $userId)->latest('created_at')->latest('id')
            ->pluck(static::TARGET_KEY)->map(static fn (mixed $id): int => (int) $id)->all();
    }

    public static function contains(int $userId, int $targetId): bool
    {
        return static::query()->where('user_id', $userId)->where(static::TARGET_KEY, $targetId)->exists();
    }

    public static function remember(int $userId, int $targetId, array $timestamps = []): void
    {
        $record = static::withTrashed()->firstOrCreate(['user_id' => $userId, static::TARGET_KEY => $targetId]);
        if ($record->trashed()) {
            $record->restore();
        }
        if ($timestamps !== []) {
            $record->forceFill($timestamps)->save();
        }
    }

    public static function toggleForUser(int $userId, int $targetId): bool
    {
        $record = static::query()->where('user_id', $userId)->where(static::TARGET_KEY, $targetId)->first();
        if ($record !== null) {
            $record->delete();

            return false;
        }
        static::remember($userId, $targetId);

        return true;
    }
}
