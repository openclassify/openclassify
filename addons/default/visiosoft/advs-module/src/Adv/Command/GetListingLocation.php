<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\LocationModule\Neighborhood\NeighborhoodRepository;

class GetListingLocation
{
    protected $locationInfo;
    protected $currentAdv;

    public function __construct($locationInfo, $currentAdv)
    {
        $this->locationInfo = $locationInfo;
        $this->currentAdv = $currentAdv;
    }

    public function handle(NeighborhoodRepository $neighborhoodRepository)
    {
        switch ($this->locationInfo) {
            case 'country':
                $locationText =  $this->currentAdv->country_name ?? '' ;
                break;
            case 'city':
                $locationText =  $this->currentAdv->city_name ?? '';
                break;
            case 'district':
                $locationText =  $this->currentAdv->district_name ?? '';
                break;
            case 'neighborhood':
                $locationText = $neighborhoodRepository->newQuery()->find($this->currentAdv->neighborhood)->name ?? '';
                break;
            default:
                $locationText = '';
        }
        return $locationText;
    }
}