<?php

namespace Modules\Conversation\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\App\Models\User;

class ConversationMessage extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id', 'sender_id', 'body', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('created_at');
    }

    public function toRealtimePayloadFor(int $viewerId): array
    {
        $this->loadMissing('sender:id,name');

        return [
            'id' => (int) $this->getKey(),
            'body' => (string) $this->body,
            'time' => $this->created_at?->format('H:i') ?? now()->format('H:i'),
            'sender_id' => (int) $this->sender_id,
            'sender_name' => (string) ($this->sender?->name ?? 'User'),
            'is_mine' => (int) $this->sender_id === $viewerId,
        ];
    }
}
