<?php
namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country_id', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function country() { return $this->belongsTo(Country::class); }
    public function districts() { return $this->hasMany(District::class); }
}
