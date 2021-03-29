<?php namespace Visiosoft\ProfileModule\Adress;

use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Contract\AdressInterface;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;

class AdressModel extends ProfileAdressEntryModel implements AdressInterface
{
    public function getAdress($id = null)
    {
        if (!$id) {
            return AdressModel::query();
        }

        return AdressModel::query()->where('id', $id)->whereNull('deleted_at');
    }

    public function getAdressFirst($id)
    {
        return $this->getAdress($id)->first();
    }

    public function getUserAdress($id = null)
    {
        $id = auth_id_if_null($id);

        return $this->query()->where('user_id', $id)->whereNull('deleted_at')->get();
    }

    public function getCountry()
    {
        return app(CountryRepositoryInterface::class)->find($this->country_id);
    }

    public function getCity()
    {
        return app(CityRepositoryInterface::class)->find($this->city);
    }
}
