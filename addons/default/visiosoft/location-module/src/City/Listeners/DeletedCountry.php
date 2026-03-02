<?php namespace Visiosoft\LocationModule\City\Listeners;

use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\City\Events\DeletedCities;

class DeletedCountry
{
    public $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function handle(\Visiosoft\LocationModule\Country\Events\DeletedCountry $event)
    {
        $country = $event->getCountry();

        $query = $this->cityRepository->newQuery()
            ->where('parent_country_id', $country->id);

        if (count($cities = $query->get())) {
            $query->delete();

            event(new DeletedCities($cities));
        }
    }
}