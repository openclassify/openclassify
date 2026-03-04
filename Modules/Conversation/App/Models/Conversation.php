<?php

namespace Modules\Conversation\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['listing_id', 'seller_id', 'buyer_id', 'last_message_at'];

    protected $casts = ['last_message_at' => 'datetime'];

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
        return $this->hasOne(ConversationMessage::class)
            ->latestOfMany()
            ->select([
                'conversation_messages.id',
                'conversation_messages.conversation_id',
                'conversation_messages.sender_id',
                'conversation_messages.body',
                'conversation_messages.created_at',
            ]);
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where(function (Builder $participantQuery) use ($userId): void {
            $participantQuery->where('buyer_id', $userId)->orWhere('seller_id', $userId);
        });
    }

    public function scopeApplyMessageFilter(Builder $query, int $userId, string $messageFilter): Builder
    {
        if (! in_array($messageFilter, ['unread', 'important'], true)) {
            return $query;
        }

        return $query->whereHas('messages', function (Builder $messageQuery) use ($userId): void {
            $messageQuery->where('sender_id', '!=', $userId)->whereNull('read_at');
        });
    }

    public function scopeWithInboxData(Builder $query, int $userId): Builder
    {
        return $query
            ->with([
                'listing:id,title,price,currency,user_id',
                'buyer:id,name',
                'seller:id,name',
                'lastMessage',
                'lastMessage.sender:id,name',
            ])
            ->withCount([
                'messages as unread_count' => fn (Builder $messageQuery) => $messageQuery
                    ->where('sender_id', '!=', $userId)
                    ->whereNull('read_at'),
            ])
            ->orderByDesc('last_message_at')
            ->orderByDesc('updated_at');
    }

    public static function inboxForUser(int $userId, string $messageFilter = 'all'): EloquentCollection
    {
        return static::query()
            ->forUser($userId)
            ->applyMessageFilter($userId, $messageFilter)
            ->withInboxData($userId)
            ->get();
    }

    public static function resolveSelected(EloquentCollection $conversations, ?int $conversationId): ?self
    {
        $selectedConversationId = $conversationId;

        if (($selectedConversationId ?? 0) <= 0 && $conversations->isNotEmpty()) {
            $selectedConversationId = (int) $conversations->first()->getKey();
        }

        if (($selectedConversationId ?? 0) <= 0) {
            return null;
        }

        $selected = $conversations->firstWhere('id', $selectedConversationId);

        if (! $selected instanceof self) {
            return null;
        }

        return $selected;
    }

    public function loadThread(): void
    {
        $this->load([
            'listing:id,title,price,currency,user_id',
            'messages' => fn (Builder $query) => $query->with('sender:id,name')->orderBy('created_at'),
        ]);
    }

    public function markAsReadFor(int $userId): void
    {
        ConversationMessage::query()
            ->where('conversation_id', $this->getKey())
            ->where('sender_id', '!=', $userId)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'updated_at' => now(),
            ]);
    }

    public static function openForListingBuyer(Listing $listing, int $buyerId): self
    {
        $conversation = static::query()->firstOrCreate(
            [
                'listing_id' => $listing->getKey(),
                'buyer_id' => $buyerId,
            ],
            [
                'seller_id' => $listing->user_id,
            ],
        );

        if ((int) $conversation->seller_id !== (int) $listing->user_id) {
            $conversation->forceFill(['seller_id' => $listing->user_id])->save();
        }

        return $conversation;
    }

    public static function buyerListingConversationId(int $listingId, int $buyerId): ?int
    {
        $value = static::query()
            ->where('listing_id', $listingId)
            ->where('buyer_id', $buyerId)
            ->value('id');

        return is_null($value) ? null : (int) $value;
    }
}
