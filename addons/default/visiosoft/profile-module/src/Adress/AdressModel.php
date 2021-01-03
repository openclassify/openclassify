<?php namespace Visiosoft\ProfileModule\Adress;

use Illuminate\Support\Facades\Auth;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Contract\AdressInterface;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;

class AdressModel extends ProfileAdressEntryModel implements AdressInterface
{
    public function getAdress($id = null)
    {
        if ($id == null) {
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
        if ($id != null) {
            return $this->query()->where('user_id', $id)->whereNull('deleted_at')->get();
        }
        return $this->query()->where('user_id', Auth::id())->whereNull('deleted_at')->get();
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
