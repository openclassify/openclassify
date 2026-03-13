<?php

namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Country extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'code', 'phone_code', 'flag', 'is_active'];

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

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public static function idNameOptions(bool $onlyActive = false): array
    {
        return static::query()
            ->when($onlyActive, fn (Builder $query): Builder => $query->active())
            ->orderBy('name')
            ->pluck('name', 'id')
            ->all();
    }

    public static function codeOptions(bool $onlyActive = false): array
    {
        return static::query()
            ->when($onlyActive, fn (Builder $query): Builder => $query->active())
            ->orderBy('code')
            ->pluck('code', 'code')
            ->all();
    }

    public static function nameOptions(bool $onlyActive = false): array
    {
        return static::query()
            ->when($onlyActive, fn (Builder $query): Builder => $query->active())
            ->orderBy('name')
            ->pluck('name', 'name')
            ->all();
    }

    public static function quickCreateOptions(): array
    {
        return static::query()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (self $country): array => [
                'id' => (int) $country->id,
                'name' => (string) $country->name,
            ])
            ->all();
    }

    public static function headerLocationOptions(): array
    {
        return static::query()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name', 'code'])
            ->map(fn (self $country): array => [
                'id' => (int) $country->id,
                'name' => (string) $country->name,
                'code' => strtoupper((string) $country->code),
            ])
            ->all();
    }

    public static function resolveLookup(string $value): ?self
    {
        $lookupValue = trim($value);

        if ($lookupValue === '') {
            return null;
        }

        $lookupCode = strtoupper($lookupValue);
        $lookupName = mb_strtolower($lookupValue);

        return static::query()
            ->where(function (Builder $query) use ($lookupCode, $lookupName, $lookupValue): void {
                if (ctype_digit($lookupValue)) {
                    $query->orWhere('id', (int) $lookupValue);
                }

                $query
                    ->orWhereRaw('UPPER(code) = ?', [$lookupCode])
                    ->orWhereRaw('LOWER(name) = ?', [$lookupName]);
            })
            ->first();
    }

    public function cityPayloads(bool $onlyActive = true): array
    {
        $cities = $this->cities()
            ->when($onlyActive, fn (Builder $query): Builder => $query->active())
            ->orderBy('name')
            ->get(['id', 'name', 'country_id']);

        if ($onlyActive && $cities->isEmpty()) {
            return $this->cityPayloads(false);
        }

        return $cities
            ->map(fn (City $city): array => [
                'id' => (int) $city->id,
                'name' => (string) $city->name,
                'country_id' => (int) $city->country_id,
            ])
            ->all();
    }
}
