<?php namespace Visiosoft\AdvsModule\Status;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;

class StatusSeeder extends Seeder
{
    public function run(StatusRepositoryInterface $statusRepository)
    {
        // System statuses
        $systemStatuses = [
            [
                'name' => 'Approved',
                'slug' => 'approved',
            ],
            [
                'name' => 'Declined',
                'slug' => 'declined',
            ],
            [
                'name' => 'Passive',
                'slug' => 'passive',
            ],
            [
                'name' => 'Pending User',
                'slug' => 'pending_user',
            ],
        ];

        foreach ($systemStatuses as $status) {
            if (!$statusRepository->findBy('slug', $status['slug'])) {
                $statusRepository->create([
                    'name' => $status['name'],
                    'slug' => $status['slug'],
                    'is_system' => true,
                    'user_access' => false,
                ]);
            }
        }
    }
}
