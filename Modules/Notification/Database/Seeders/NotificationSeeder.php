<?php

declare(strict_types=1);

namespace Modules\Notification\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Notification\Models\UserNotification;
use Modules\User\App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->orderBy('id')->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all();

        if ($userIds === []) {
            return;
        }

        foreach ($userIds as $position => $userId) {
            foreach ($this->samples() as $index => $sample) {
                $isRead = ($position + $index) % 3 === 0;

                UserNotification::query()->create([
                    'user_id' => $userId,
                    'type' => $sample['type'],
                    'title' => $sample['title'],
                    'body' => $sample['body'],
                    'action_url' => $sample['action_url'],
                    'read_at' => $isRead ? now()->subDays($index + 1) : null,
                    'created_at' => now()->subDays($index)->subHours($position),
                    'updated_at' => now()->subDays($index)->subHours($position),
                ]);
            }
        }
    }

    private function samples(): array
    {
        return [
            [
                'type' => UserNotification::TYPE_OFFER,
                'title' => 'New offer received',
                'body' => 'A buyer sent an offer on one of your listings.',
                'action_url' => '/panel/offers',
            ],
            [
                'type' => UserNotification::TYPE_MESSAGE,
                'title' => 'New message',
                'body' => 'You have an unread message in your inbox.',
                'action_url' => '/panel/inbox',
            ],
            [
                'type' => UserNotification::TYPE_REVIEW,
                'title' => 'New review',
                'body' => 'Someone rated their experience with you.',
                'action_url' => '/panel/reviews',
            ],
            [
                'type' => UserNotification::TYPE_LISTING,
                'title' => 'Listing expiring soon',
                'body' => 'One of your listings ends in three days. Republish it to stay visible.',
                'action_url' => '/panel/my-listings',
            ],
            [
                'type' => UserNotification::TYPE_SAVED_SEARCH,
                'title' => 'New results for a saved search',
                'body' => 'Fresh listings match one of your saved searches.',
                'action_url' => '/favorites',
            ],
        ];
    }
}
