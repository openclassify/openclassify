<?php

namespace Modules\Video\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Listing\Models\Listing;
use Modules\User\App\Models\User;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Models\Video;

class VideoDemoSeeder extends Seeder
{
    private const VIDEO_BLUEPRINTS = [
        'a@a.com' => [
            [
                'title' => 'Workspace walkaround',
                'description' => 'Pending demo video for upload and processing states.',
                'status' => VideoStatus::Pending,
                'is_active' => true,
                'processing_error' => null,
            ],
            [
                'title' => 'Packaging close-up',
                'description' => 'Failed demo video to test retry and edit flows.',
                'status' => VideoStatus::Failed,
                'is_active' => false,
                'processing_error' => 'Demo processing was skipped intentionally.',
            ],
        ],
        'b@b.com' => [
            [
                'title' => 'Short product overview',
                'description' => 'Pending demo video for the member workspace.',
                'status' => VideoStatus::Pending,
                'is_active' => true,
                'processing_error' => null,
            ],
            [
                'title' => 'Condition details clip',
                'description' => 'Failed demo video to show a second panel state.',
                'status' => VideoStatus::Failed,
                'is_active' => false,
                'processing_error' => 'Demo processing was skipped intentionally.',
            ],
        ],
    ];

    public function run(): void
    {
        if (! Schema::hasTable('videos') || ! Schema::hasTable('listings')) {
            return;
        }

        foreach (self::VIDEO_BLUEPRINTS as $email => $blueprints) {
            $user = User::query()->where('email', $email)->first();

            if (! $user) {
                continue;
            }

            $listings = Listing::query()
                ->where('user_id', $user->getKey())
                ->where('status', 'active')
                ->orderBy('id')
                ->take(count($blueprints))
                ->get();

            foreach ($blueprints as $index => $blueprint) {
                $listing = $listings->get($index);

                if (! $listing) {
                    continue;
                }

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
                    'sort_order' => $index + 1,
                    'is_active' => $blueprint['is_active'],
                    'processing_error' => $blueprint['processing_error'],
                    'processed_at' => null,
                ])->saveQuietly();
            }
        }
    }
}
