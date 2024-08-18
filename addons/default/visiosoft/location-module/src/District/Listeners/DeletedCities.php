<?php namespace Visiosoft\LocationModule\District\Listeners;

use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\District\Events\DeletedDistricts;

class DeletedCities
{
    public $districtRepository;

    public function __construct(DistrictRepositoryInterface $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    public function handle(\Visiosoft\LocationModule\City\Events\DeletedCities $event)
    {
        $cities = $event->getCities();

        $cities = $cities->pluck('id')->all();

        $query = $this->districtRepository->newQuery()
            ->whereIn('parent_city_id', $cities);

        if (count($districts = $query->get())) {
            $query->delete();

            event(new DeletedDistricts($districts));
        }
    }
}