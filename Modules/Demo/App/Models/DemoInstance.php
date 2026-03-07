<?php

namespace Modules\Demo\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DemoInstance extends Model
{
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

    public function scopeActiveUuid(Builder $query, string $uuid): Builder
    {
        return $query
            ->where('uuid', $uuid)
            ->where('expires_at', '>', now());
    }
}
