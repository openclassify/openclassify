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
        $partner = User::query()->where('email', 'b@b.com')->first();

        if (! $admin || ! $partner) {
            return;
        }

        $listings = Listing::query()
            ->where('user_id', $admin->getKey())
            ->where('status', 'active')
            ->orderBy('id')
            ->take(2)
            ->get();

        if ($listings->count() < 2) {
            return;
        }

        $this->seedConversationThread(
            $listings->get(0),
            $admin,
            $partner,
            [
                ['sender' => 'partner', 'body' => 'Hi, is this still available?', 'hours_ago' => 30, 'read_after_minutes' => 4],
                ['sender' => 'admin', 'body' => 'Yes, it is available. I can share more photos.', 'hours_ago' => 29, 'read_after_minutes' => 7],
                ['sender' => 'partner', 'body' => 'Perfect. Can we meet tomorrow afternoon?', 'hours_ago' => 4, 'read_after_minutes' => null],
            ]
        );

        $this->seedConversationThread(
            $listings->get(1),
            $admin,
            $partner,
            [
                ['sender' => 'partner', 'body' => 'Can you confirm the final price?', 'hours_ago' => 20, 'read_after_minutes' => 8],
                ['sender' => 'admin', 'body' => 'I can do a small discount if you pick it up today.', 'hours_ago' => 18, 'read_after_minutes' => null],
            ]
        );
    }

    private function conversationTablesExist(): bool
    {
        return Schema::hasTable('conversations') && Schema::hasTable('conversation_messages');
    }

    private function seedConversationThread(
        ?Listing $listing,
        User $admin,
        User $partner,
        array $messages
    ): void {
        if (! $listing) {
            return;
        }

        $conversation = Conversation::updateOrCreate(
            [
                'listing_id' => $listing->getKey(),
                'buyer_id' => $partner->getKey(),
            ],
            [
                'seller_id' => $admin->getKey(),
                'last_message_at' => now(),
            ]
        );

        ConversationMessage::query()
            ->where('conversation_id', $conversation->getKey())
            ->delete();

        $lastMessageAt = null;

        foreach ($messages as $payload) {
            $createdAt = now()->subHours((int) $payload['hours_ago']);
            $sender = ($payload['sender'] ?? 'partner') === 'admin' ? $admin : $partner;
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
            'seller_id' => $admin->getKey(),
            'last_message_at' => $lastMessageAt,
            'updated_at' => $lastMessageAt,
        ])->saveQuietly();
    }
}
