<?php
namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'city_id', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function city() { return $this->belongsTo(City::class); }
}
