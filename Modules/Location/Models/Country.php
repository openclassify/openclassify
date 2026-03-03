<?php
namespace Modules\Location\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'code', 'phone_code', 'flag', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
