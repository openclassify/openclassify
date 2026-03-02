<?php namespace Visiosoft\LocationModule\Village\Listeners;

use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;

class DeletedNeighborhoods
{
    public $villageRepository;

    public function __construct(VillageRepositoryInterface $villageRepository)
    {
        $this->villageRepository = $villageRepository;
    }

    public function handle(\Visiosoft\LocationModule\Neighborhood\Events\DeletedNeighborhoods $event)
    {
        $neighborhoods = $event->getNeighborhoods();

        $neighborhoods = $neighborhoods->pluck('id')->all();

        $query = $this->villageRepository->newQuery()
            ->whereIn('parent_neighborhood_id', $neighborhoods);

        if (count($villages = $query->get())) {
            $query->delete();
        }
    }
}