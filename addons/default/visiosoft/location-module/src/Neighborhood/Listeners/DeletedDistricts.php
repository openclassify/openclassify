<?php namespace Visiosoft\LocationModule\Neighborhood\Listeners;


use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\Events\DeletedNeighborhoods;

class DeletedDistricts
{
    public $neighborhoodRepository;

    public function __construct(NeighborhoodRepositoryInterface $neighborhoodRepository)
    {
        $this->neighborhoodRepository = $neighborhoodRepository;
    }

    public function handle(\Visiosoft\LocationModule\District\Events\DeletedDistricts $event)
    {
        $districts = $event->getDistricts();

        $districts = $districts->pluck('id')->all();

        $query = $this->neighborhoodRepository->newQuery()
            ->whereIn('parent_district_id', $districts);

        if (count($neighborhoods = $query->get())) {
            $query->delete();

            event(new DeletedNeighborhoods($neighborhoods));
        }
    }
}