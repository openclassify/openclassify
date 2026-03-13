<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'country_id', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public static function nameOptions(?string $countryName = null, bool $onlyActive = true): array
    {
        return static::query()
            ->when($onlyActive, fn (Builder $query): Builder => $query->active())
            ->when(
                $countryName && trim($countryName) !== '',
                fn (Builder $query): Builder => $query->whereHas(
                    'country',
                    fn (Builder $countryQuery): Builder => $countryQuery->where('name', trim($countryName)),
                ),
            )
            ->orderBy('name')
            ->pluck('name', 'name')
            ->all();
    }

    public static function quickCreateOptions(): array
    {
        return static::query()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name', 'country_id'])
            ->map(fn (self $city): array => [
                'id' => (int) $city->id,
                'name' => (string) $city->name,
                'country_id' => (int) $city->country_id,
            ])
            ->all();
    }

    public function districtPayloads(): array
    {
        return $this->districts()
            ->orderBy('name')
            ->get()
            ->map(fn (District $district): array => [
                'id' => (int) $district->id,
                'name' => (string) $district->name,
                'city_id' => (int) $district->city_id,
            ])
            ->all();
    }
}
