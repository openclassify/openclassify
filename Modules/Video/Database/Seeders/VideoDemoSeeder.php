<?php

namespace Modules\Video\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;
use Modules\User\App\Support\DemoUserCatalog;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Models\Video;

class VideoDemoSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()
            ->whereIn('email', DemoUserCatalog::emails())
            ->orderBy('email')
            ->get()
            ->values();

        foreach ($users as $userIndex => $user) {
            $listings = Listing::query()
                ->where('user_id', $user->getKey())
                ->where('status', 'active')
                ->orderBy('id')
                ->take(2)
                ->get();

            foreach ($listings as $listingIndex => $listing) {
                $blueprint = $this->blueprintFor($userIndex, $listingIndex);

                $video = Video::query()->firstOrNew([
                    'listing_id' => $listing->getKey(),
                    'user_id' => $user->getKey(),
                    'title' => $blueprint['title'],
                ]);

                $video->forceFill([
                    'listing_id' => $listing->getKey(),
                    'user_id' => $user->getKey(),
                    'title' => $blueprint['title'],
                    'description' => $blueprint['description'],
                    'status' => $blueprint['status'],
                    'disk' => 'public',
                    'path' => null,
                    'upload_disk' => 'public',
                    'upload_path' => null,
                    'mime_type' => 'video/mp4',
                    'size' => null,
                    'sort_order' => $listingIndex + 1,
                    'is_active' => $blueprint['is_active'],
                    'processing_error' => $blueprint['processing_error'],
                    'processed_at' => null,
                ])->saveQuietly();
            }
        }
    }

    private function blueprintFor(int $userIndex, int $listingIndex): array
    {
        if ($listingIndex === 0) {
            return [
                'title' => 'Quick walkthrough '.($userIndex + 1),
                'description' => 'Pending demo video for uploader and panel testing.',
                'status' => VideoStatus::Pending,
                'is_active' => true,
                'processing_error' => null,
            ];
        }

        return [
            'title' => 'Condition details '.($userIndex + 1),
            'description' => 'Failed demo video for status handling and retry UI testing.',
            'status' => VideoStatus::Failed,
            'is_active' => false,
            'processing_error' => 'Demo processing was skipped intentionally.',
        ];
    }
}
