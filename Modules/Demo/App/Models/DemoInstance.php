<?php

declare(strict_types=1);

namespace Modules\Demo\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\LazyCollection;

class DemoInstance extends Model
{
    use SoftDeletes;

    protected $connection = 'pgsql_public';

    protected $fillable = [
        'uuid',
        'schema_name',
        'prepared_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'prepared_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public static function findActive(string $uuid): ?self
    {
        return static::query()->activeUuid($uuid)->first();
    }

    public static function findByUuid(string $uuid): ?self
    {
        return static::query()->where('uuid', $uuid)->first();
    }

    public static function expired(): LazyCollection
    {
        return static::query()->where('expires_at', '<=', now())->lazyById();
    }

    public static function activeCount(): int
    {
        return static::query()->where('expires_at', '>', now())->count();
    }

    public static function prepare(string $uuid, string $schema): self
    {
        return static::query()->updateOrCreate(['uuid' => $uuid], [
            'schema_name' => $schema,
            'prepared_at' => now(),
            'expires_at' => now()->addMinutes((int) config('demo.ttl_minutes', 360)),
        ]);
    }

    public function extendExpiry(): void
    {
        $this->forceFill(['expires_at' => now()->addMinutes((int) config('demo.ttl_minutes', 360))])->save();
    }

    public static function createSchema(string $schema): void
    {
        (new static)->getConnection()->statement('CREATE SCHEMA IF NOT EXISTS '.static::quoteIdentifier($schema));
    }

    public static function dropSchema(string $schema): void
    {
        (new static)->getConnection()->statement('DROP SCHEMA IF EXISTS '.static::quoteIdentifier($schema).' CASCADE');
    }

    private static function quoteIdentifier(string $identifier): string
    {
        if (! preg_match('/^[a-z0-9_]+$/', $identifier)) {
            throw new \RuntimeException('Invalid demo schema identifier.');
        }

        return '"'.$identifier.'"';
    }

    public function scopeActiveUuid(Builder $query, string $uuid): Builder
    {
        return $query
            ->where('uuid', $uuid)
            ->where('expires_at', '>', now());
    }
}
