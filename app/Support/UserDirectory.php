<?php

declare(strict_types=1);

namespace App\Support;

use Modules\User\App\Models\User;

final class UserDirectory
{
    public static function resolve(array $userIds): array
    {
        $unique = array_values(array_unique($userIds));

        if ($unique === []) {
            return [];
        }

        return User::query()
            ->whereIn('id', $unique)
            ->get(['id', 'name', 'created_at'])
            ->mapWithKeys(static fn (User $user): array => [
                (int) $user->getKey() => [
                    'id' => (int) $user->getKey(),
                    'name' => (string) $user->getAttribute('name'),
                    'initials' => self::initials((string) $user->getAttribute('name')),
                    'avatar' => null,
                    'joined_at' => $user->getAttribute('created_at')?->toDateString(),
                ],
            ])
            ->all();
    }

    public static function find(int $userId): ?array
    {
        return self::resolve([$userId])[$userId] ?? null;
    }

    public static function nameFor(int $userId): string
    {
        $name = User::query()->whereKey($userId)->value('name');

        return is_string($name) ? $name : '';
    }

    public static function exists(int $userId): bool
    {
        return User::query()->whereKey($userId)->exists();
    }

    public static function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $letters = array_map(
            static fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)),
            array_slice(array_filter($parts), 0, 2)
        );

        $initials = implode('', $letters);

        return $initials !== '' ? $initials : '?';
    }
}
