<?php

declare(strict_types=1);

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Profile extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = ['user_id', 'avatar', 'bio', 'phone', 'city', 'country', 'website', 'is_verified'];

    protected $casts = ['is_verified' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function detailsForUser(User $user): ?self
    {
        return static::query()
            ->where('user_id', $user->getKey())
            ->first();
    }

    public static function phoneForUser(User $user): ?string
    {
        return static::query()
            ->where('user_id', $user->getKey())
            ->value('phone');
    }
}
