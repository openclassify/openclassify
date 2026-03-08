<?php

namespace Modules\Conversation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Models\ConversationMessage;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;

class ConversationDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! $this->conversationTablesExist()) {
            return;
        }

        $admin = User::query()->where('email', 'a@a.com')->first();
        $member = User::query()->where('email', 'b@b.com')->first();

        if (! $admin || ! $member) {
            return;
        }

        $adminListings = Listing::query()
            ->where('user_id', $admin->getKey())
            ->where('status', 'active')
            ->orderBy('id')
            ->take(2)
            ->get();

        $memberListings = Listing::query()
            ->where('user_id', $member->getKey())
            ->where('status', 'active')
            ->orderBy('id')
            ->take(2)
            ->get();

        if ($adminListings->count() < 2 || $memberListings->count() < 2) {
            return;
        }

        $this->seedConversationThread(
            $admin,
            $member,
            $adminListings->get(0),
            [
                ['sender' => 'buyer', 'body' => 'Hi, is this still available?', 'hours_ago' => 30, 'read_after_minutes' => 4],
                ['sender' => 'seller', 'body' => 'Yes, it is. I can share more photos.', 'hours_ago' => 29, 'read_after_minutes' => 7],
                ['sender' => 'buyer', 'body' => 'Perfect. Can we meet tomorrow afternoon?', 'hours_ago' => 4, 'read_after_minutes' => null],
            ]
        );

        $this->seedConversationThread(
            $admin,
            $member,
            $adminListings->get(1),
            [
                ['sender' => 'buyer', 'body' => 'Can you confirm the final price?', 'hours_ago' => 20, 'read_after_minutes' => 8],
                ['sender' => 'seller', 'body' => 'I can do a small discount if you pick it up today.', 'hours_ago' => 18, 'read_after_minutes' => null],
            ]
        );

        $this->seedConversationThread(
            $member,
            $admin,
            $memberListings->get(0),
            [
                ['sender' => 'buyer', 'body' => 'Hello, does this listing include the original accessories?', 'hours_ago' => 14, 'read_after_minutes' => 6],
                ['sender' => 'seller', 'body' => 'Yes, box and accessories are included.', 'hours_ago' => 13, 'read_after_minutes' => 9],
                ['sender' => 'buyer', 'body' => 'Great. I can pick it up tonight.', 'hours_ago' => 2, 'read_after_minutes' => null],
            ]
        );

        $this->seedConversationThread(
            $member,
            $admin,
            $memberListings->get(1),
            [
                ['sender' => 'buyer', 'body' => 'Would you accept a bank transfer?', 'hours_ago' => 11, 'read_after_minutes' => 5],
                ['sender' => 'seller', 'body' => 'Yes, that works for me.', 'hours_ago' => 10, 'read_after_minutes' => null],
            ]
        );
    }

    private function conversationTablesExist(): bool
    {
        return Schema::hasTable('conversations') && Schema::hasTable('conversation_messages');
    }

    private function seedConversationThread(
        User $seller,
        User $buyer,
        ?Listing $listing,
        array $messages
    ): void {
        if (! $listing) {
            return;
        }

        $conversation = Conversation::updateOrCreate(
            [
                'listing_id' => $listing->getKey(),
                'buyer_id' => $buyer->getKey(),
            ],
            [
                'seller_id' => $seller->getKey(),
                'last_message_at' => now(),
            ]
        );

        ConversationMessage::query()
            ->where('conversation_id', $conversation->getKey())
            ->delete();

        $lastMessageAt = null;

        foreach ($messages as $payload) {
            $createdAt = now()->subHours((int) $payload['hours_ago']);
            $sender = ($payload['sender'] ?? 'buyer') === 'seller' ? $seller : $buyer;
            $readAfterMinutes = $payload['read_after_minutes'];
            $readAt = is_numeric($readAfterMinutes) ? $createdAt->copy()->addMinutes((int) $readAfterMinutes) : null;

            $message = new ConversationMessage();
            $message->forceFill([
                'conversation_id' => $conversation->getKey(),
                'sender_id' => $sender->getKey(),
                'body' => (string) $payload['body'],
                'read_at' => $readAt,
                'created_at' => $createdAt,
                'updated_at' => $readAt ?? $createdAt,
            ])->save();

            $lastMessageAt = $createdAt;
        }

        $conversation->forceFill([
            'seller_id' => $seller->getKey(),
            'last_message_at' => $lastMessageAt,
            'updated_at' => $lastMessageAt,
        ])->saveQuietly();
    }
}
