<?php

declare(strict_types=1);

namespace Modules\Report\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\Report\Models\Report;
use Modules\User\App\Models\User;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $reporterIds = User::query()->orderBy('id')->limit(5)->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all();

        if ($reporterIds === []) {
            return;
        }

        $listingIds = Listing::query()
            ->orderByDesc('id')
            ->limit(6)
            ->pluck('id')
            ->map(static fn (mixed $id): int => (int) $id)
            ->all();

        $samples = $this->samples();
        $index = 0;

        foreach ($listingIds as $listingId) {
            $sample = $samples[$index % count($samples)];

            Report::query()->create([
                'subject_type' => Report::SUBJECT_LISTING,
                'subject_id' => $listingId,
                'reporter_id' => $reporterIds[$index % count($reporterIds)],
                'reason' => $sample['reason'],
                'details' => $sample['details'],
                'status' => $sample['status'],
                'resolved_at' => $sample['status'] === Report::STATUS_OPEN ? null : now()->subDays($index + 1),
                'created_at' => now()->subDays($index + 2),
                'updated_at' => now()->subDays($index + 1),
            ]);

            $index++;
        }
    }

    private function samples(): array
    {
        return [
            ['reason' => 'wrong_category', 'details' => 'This belongs under electronics, not furniture.', 'status' => Report::STATUS_OPEN],
            ['reason' => 'duplicate', 'details' => 'The same item is posted three times by this seller.', 'status' => Report::STATUS_REVIEWING],
            ['reason' => 'spam', 'details' => 'Description is a link farm with no real item.', 'status' => Report::STATUS_RESOLVED],
            ['reason' => 'sold_elsewhere', 'details' => 'Seller told me it sold last week but the listing is still live.', 'status' => Report::STATUS_OPEN],
            ['reason' => 'fraud', 'details' => 'Asked for a deposit before showing the item.', 'status' => Report::STATUS_REVIEWING],
            ['reason' => 'other', 'details' => 'Photos are taken from another website.', 'status' => Report::STATUS_DISMISSED],
        ];
    }
}
