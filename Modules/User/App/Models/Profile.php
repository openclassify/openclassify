<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Profile extends Model
{
    use LogsActivity;

    protected $fillable = ['user_id', 'avatar', 'bio', 'phone', 'city', 'country', 'website', 'is_verified'];

    protected $casts = ['is_verified' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
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
