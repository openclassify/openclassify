<?php
namespace Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'avatar', 'bio', 'phone', 'city', 'country', 'website', 'is_verified'];
    protected $casts = ['is_verified' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
