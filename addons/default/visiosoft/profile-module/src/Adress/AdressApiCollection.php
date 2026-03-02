<?php namespace Visiosoft\ProfileModule\Adress;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Visiosoft\ConnectModule\Command\CheckRequiredParams;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\Country\CountryRepository;
use Visiosoft\LocationModule\District\DistrictRepository;

class AdressApiCollection extends AdressRepository
{
    use DispatchesJobs;

    public function add(array $params)
    {
        $required_params = ['name', 'first_name', 'last_name', 'gsm_phone', 'country_id', 'city_id',
            'district_id', 'content'];

        $this->dispatchSync(new CheckRequiredParams($required_params, $params));

        if (isset($params['id'])) {
            unset($params['id']);
        }

        $city_repository = app(CityRepository::class);
        $district_repository = app(DistrictRepository::class);
        $country_repository = app(CountryRepository::class);

        if (!$country = $country_repository->find($params['country_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Country']), 404);
        }

        if (!$city = $city_repository->find($params['city_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'City']), 404);
        }

        if (!$district = $district_repository->find($params['district_id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'District']), 404);
        }

        if ($city->parent_country_id != $params['country_id']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $country->name, 'to' => $city->name]), 404);
        }

        if ($district->parent_city_id != $params['city_id']) {
            throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $city->name, 'to' => $district->name]), 404);
        }

        $create_parameters = [
            'adress_name' => $params['name'],
            'adress_gsm_phone' => $params['gsm_phone'],
            'adress_first_name' => $params['first_name'],
            'adress_last_name' => $params['last_name'],
            'country_id' => $params['country_id'],
            'city' => $params['city_id'],
            'district' => $params['district_id'],
            'adress_content' => $params['content'],
            'user_id' => Auth::id(),
            'created_by_id' => Auth::id(),
            'created_at' => Carbon::now(),
        ];

        if (!empty($params['company']) && !empty($params['tax_number']) && !empty($params['tax_office'])) {
            $create_parameters = array_merge($create_parameters, [
                'company' => $params['company'],
                'tax_number' => $params['tax_number'],
                'tax_office' => $params['tax_office'],
                'is_company' => true,
            ]);
        }

        $address = $this->newQuery()->create($create_parameters);
        $address->city_name = $city->name;
        $address->country_name = $country->name;
        $address->district_name = $district->name;

        unset($address->user_id, $address->is_company);

        return $address;
    }

    public function edit(array $params)
    {
        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        $city_repository = app(CityRepository::class);
        $district_repository = app(DistrictRepository::class);
        $country_repository = app(CountryRepository::class);

        if (!$address = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Address']), 404);
        }

        if ($address->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        if (!empty($params['country_id'])) {
            if (!$country = $country_repository->find($params['country_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Country']), 404);
            }
        }

        if (!empty($params['city_id'])) {
            if (!$city = $city_repository->find($params['city_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'City']), 404);
            }

            if ($city->parent_country_id != $address->country_id) {
                throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $country->name, 'to' => $city->name]), 404);
            }
        }

        if (!empty($params['district_id'])) {
            if (!$district = $district_repository->find($params['district_id'])) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'District']), 404);
            }

            if ($district->parent_city_id != $address->city) {
                throw new \Exception(trans('visiosoft.module.profile::message.found_in', ['source' => $city->name, 'to' => $district->name]), 404);
            }
        }

        $params = $this->paramsMatcher($params);

        if (!empty($params['company']) && !empty($params['tax_number']) && !empty($params['tax_office'])) {
            $params = array_merge($params, [
                'company' => $params['company'],
                'tax_number' => $params['tax_number'],
                'tax_office' => $params['tax_office'],
                'is_company' => true,
            ]);
        }

        $address->update(array_merge([
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ], $params));

        return collect(['message' => trans('streams::message.edit_success', ['name' => $params['id']])]);
    }

    public function paramsMatcher($params)
    {
        $list = [
            'name' => 'adress_name',
            'gsm_phone' => 'adress_gsm_phone',
            'first_name' => 'adress_first_name',
            'last_name' => 'adress_last_name',
            'city_id' => 'city',
            'district_id' => 'district',
            'content' => 'adress_content'
        ];

        foreach ($list as $key => $item) {
            if (!empty($params[$key])) {
                $params[$item] = $params[$key];
                unset($params[$key]);
            }
        }

        return $params;
    }

    public function remove(array $params)
    {

        $this->dispatchSync(new CheckRequiredParams(['id'], $params));

        if (!$address = $this->find($params['id'])) {
            throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Address']), 404);
        }

        if ($address->created_by_id != Auth::id()) {
            throw new \Exception(trans('streams::message.access_denied'), 403);
        }

        $address->update([
            'deleted_at' => Carbon::now(),
            'updated_by_id' => Auth::id(),
            'updated_at' => Carbon::now()
        ]);

        return collect(['message' => trans('streams::message.delete_success', ['count' => 1])]);
    }

    public function list(array $params)
    {
        if (!empty($params['id'])) {
            $address = $this->newQuery()->find($params['id']);

            if (!$address) {
                throw new \Exception(trans('visiosoft.module.connect::message.not_found', ['name' => 'Address']), 404);
            }

            unset($address->user_id, $address->is_company);

            $city_repository = app(CityRepository::class);
            $district_repository = app(DistrictRepository::class);
            $country_repository = app(CountryRepository::class);

            if ($country = $country_repository->find($address->country_id)) {
                $address->country_name = $country->name;
            }

            if ($city = $city_repository->find($address->city)) {
                $address->city_name = $city->name;
            }

            if ($district = $district_repository->find($address->district)) {
                $address->district_name = $district->name;
            }

            return $address;
        }

        return $this->newQuery()->where('created_by_id', Auth::id())->select(['adress_name', 'id']);
    }
}
