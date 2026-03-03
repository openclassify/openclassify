<?php
namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class City extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'country_id', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function country() { return $this->belongsTo(Country::class); }
    public function districts() { return $this->hasMany(District::class); }
}
