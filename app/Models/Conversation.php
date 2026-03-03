<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Listing\Models\Listing;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'seller_id',
        'buyer_id',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function messages()
    {
        return $this->hasMany(ConversationMessage::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(ConversationMessage::class)->latestOfMany();
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where(function (Builder $participantQuery) use ($userId): void {
            $participantQuery
                ->where('buyer_id', $userId)
                ->orWhere('seller_id', $userId);
        });
    }
}
