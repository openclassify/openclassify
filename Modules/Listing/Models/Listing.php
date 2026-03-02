<?php
namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price', 'currency', 'category_id',
        'user_id', 'status', 'images', 'slug',
        'contact_phone', 'contact_email', 'is_featured', 'expires_at',
        'city', 'country',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'expires_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(\Modules\Category\Models\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
