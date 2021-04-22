<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Model\Advs\AdvsCustomFieldsEntryModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\CartsModule\Cart\Command\GetCart;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageModel;

class AdvModel extends AdvsAdvsEntryModel implements AdvInterface
{
    public function is_enabled($slug)
    {
        if ($addon = app('module.collection')->get($slug)) {
            return $addon->installed;
        }
        return false;
    }

    public function is_enabled_extension($slug)
    {
        $isActive = DB::table('addons_extensions')->where('namespace', 'visiosoft.extension.' . $slug . '_provider')->first();
        if ($isActive == null) {
            return 0;
        } else
            return $isActive->enabled;
    }

    public function is_active($id)
    {
        $isActive = $this->query()
            ->where('advs_advs.id', $id)
            ->where('advs_advs.slug', '!=', "")
            ->first();
        if ($isActive->status != 'approved') {
            return 0;
        }
        return 1;
    }

    public function getAdv($id = null, $nullable_ad = false, $trashed = false)
    {
        $query = $this::query();

        if ($trashed) {
            $query = $this::withTrashed();
        }

        if ($id != null) {
            if ($nullable_ad) {
                return $query->find($id);
            } else {
                return $query->where('advs_advs.slug', '!=', "")
                    ->find($id);
            }
        }
        if ($nullable_ad) {
            return $query->newQuery();
        }
        return $query->where('advs_advs.slug', '!=', "");
    }

    public function userAdv($nullable_ad = false, $checkRole = true)
    {
        return $this->getAdv(null, $nullable_ad)
            ->where('advs_advs.created_by_id', Auth::id());
    }

    public function getAdvByCat($cat_id)
    {
        return $this->userAdv()
            ->where('cat1', $cat_id);
    }

    public function pendingAdvsByUser()
    {
        return $this->userAdv()
            ->where(function ($query) {
                $query->where('advs_advs.status', '<>', 'approved');
                $query->orWhere('advs_advs.finish_at', '<', date('Y-m-d H:i:s'));
            });
    }


    public function favsAdvsByUser($fav_ids)
    {
        return $this->userAdv()
            ->whereIn('advs_advs.id', $fav_ids)//Array favs id
            ->where('advs_advs.status', 'approved');
    }

    public function myAdvsByUser()
    {
        return $this->userAdv()
            ->where('advs_advs.status', 'approved')
            ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));
    }

    public function foreignCurrency($currency, $price, $isUpdate, $settings, $showMsg = true)
    {
        $currencies = setting_value('visiosoft.module.advs::enabled_currencies');
        $messages = app(MessageBag::class);
        $foreign_currency = array();

        foreach ($currencies as $currencyIn) {
            if ($currencyIn == $currency) {
                $foreign_currency[$currency] = (int)$price;
            } else {
                try {
                    $url = $currency . "_" . $currencyIn;
                    $freeCurrencyKey = $settings->value('visiosoft.module.advs::free_currencyconverterapi_key');

                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('GET', 'http://free.currencyconverterapi.com/api/v6/convert', ['query' => [
                        'q' => $url,
                        'compact' => 'y',
                        'apiKey' => $freeCurrencyKey
                    ]]);

                    if ($response->getStatusCode() == '200') {
                        $response = (array)\GuzzleHttp\json_decode($response->getBody()->getContents());
                        if (!empty($response)) {
                            $rate = $response[$url]->val;
                            $foreign_currency[$currencyIn] = $price * $rate;
                        }
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $response = $e->getResponse();
                    $responseBodyAsString = $response->getBody()->getContents();
                    $response = json_decode($responseBodyAsString, true);
                    if ($showMsg) {
                        $messages->error($response['error']);
                    }
                }
            }
        }
        if ($isUpdate != 0) {
            $adv = AdvsAdvsEntryModel::query()->where('advs_advs.id', $isUpdate)->first();
        } else {
            $adv = AdvsAdvsEntryModel::query()->where('advs_advs.created_by_id', auth()->user()->id)->latest()->first();
        }
        $adv->foreign_currencies = json_encode($foreign_currency);
        $adv->save();
    }

    public function popularAdvs()
    {
        return $this->getAdv()->where('status', 'approved')
            ->orderBy('count_show_ad', 'desc')->limit(10)->get();
    }

    public function advsofDay()
    {
        return $this->getAdv()->where('adv_day', 1)->paginate(9);
    }

    public function statusAds($id, $status)
    {
        $this->getAdv($id)->update(['status' => $status]);
        return $status;

    }

    public function finish_at_Ads($id, $endDate)
    {
        $date = date('Y-m-d H:i:s');
        $this->getAdv($id)->update(['finish_at' => date('Y-m-d H:i:s',
            strtotime($date . ' + ' . $endDate . ' day'))]);
    }

    public function publish_at_Ads($id)
    {
        $date = date('Y-m-d H:i:s');
        $this->getAdv($id)->update(['publish_at' => $date]);
    }

    public function getLastUserAdv()
    {
        return $this->userAdv()
            ->orderByDesc('id')
            ->first();
    }

    public function getLocationNames($advs)
    {
        foreach ($advs as $adv) {
            $country = CountryModel::query()->where('location_countries.id', $adv->country_id)->first();
            $city = CityModel::query()->where('location_cities.id', $adv->city)->first();

            if ($country != null) {
                $adv->setAttribute('country_name', $country->name);
                $adv->setAttribute('country_abv', $country->abv);
            }
            if ($city != null) {
                $adv->setAttribute('city_name', $city->name);
            }
        }
        return $advs;
    }


    public function isAdv($id)
    {
        return $this->getAdv()->where('advs_advs.id', $id)->first();
    }

    public function addCart($item, $quantity = 1, $name = null)
    {
        $cart = $this->dispatch(new GetCart());
        $cart->add($item, $quantity, $name);
        return $this->dispatch(new GetCart());
    }


    public function getAdvDetailLinkByModel($object, $type = null)
    {
        if ($type != null) {
            $id = $object->id;
            $seo = $object->slug;
            return \route('adv_detail_seo', [$seo, $id]);
        }
        $id = $object->getObject()->id;
        $seo = $object->getObject()->slug;
        return \route('adv_detail_seo', [$seo, $id]);
    }

    public function getAdvDetailLinkByAdId($id)
    {
        $adv = $this->find($id);
        if ($adv != null) {
            $id = $adv->id;
            $seo = $adv->slug;
            return \route('adv_detail_seo', [$seo, $id]);
        }
    }

    public function getAdvimage($id)
    {
        return $this->getAdv($id)->files;
    }

    public function getLatestField($slug)
    {
        return DB::table('streams_fields')->where('slug', $slug)->first();
    }

    public function updateStock($id, $quantity)
    {
        $adv = $this->getAdv($id);
        $oldStock = $adv->stock;
        $newStock = $oldStock - $quantity;
        $adv->update(['stock' => $newStock]);
    }

    public function stockControl($id, $quantity)
    {
        if($adv = $this->getAdv($id))
        {
            $stock = $adv->stock;

            if($stock and $stock >= $quantity)
            {
                return 1;
            }
        }
        return 0;
    }

    public function saveCustomField($category_id, $field_id, $name)
    {
        $all = array();
        $all['category_id'] = $category_id;
        $all['field_id'] = $field_id;
        $all['name'] = $name;

        if (AdvsCustomFieldsEntryModel::create($all)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            abort(404);
        }
    }

    public function customfields()
    {
        return $this->hasMany('Visiosoft\CustomfieldsModule\CustomFieldAdv\CustomFieldAdvModel', 'parent_adv_id', 'id');
    }

    // public function getCustomFieldEditId($id) {
    //     $custom_field = AdvsCustomFieldsEntryModel::query()->where('advs_custom_fields.id', $id)->first();
    //     return DB::table('streams_assignments')->where('field_id', $custom_field->field_id)->first();
    // }

    public function priceFormat($adv)
    {
        return number_format($adv->price, "2", ",", str_replace('&#160;', ' ', "."));
    }

    public function AddAdsDefaultCoverImage($ad)
    {
        if ($ad->cover_photo == null) {
            $ad->cover_photo = $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/no-image.png', 'img'))->url();
        } else {
            $ad->cover_photo = url($ad->cover_photo);
        }
        return $ad;
    }

    public function GetAdsDefaultCoverImageByAdId($id)
    {
        $adv = $this->find($id);
        if ($adv == null or $adv->cover_photo == null) {
            $cover_photo = $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/no-image.png', 'img'))->url();
        } else {
            $cover_photo = url($adv->cover_photo);
        }
        return $cover_photo;
    }

    public function viewed_Ad($id)
    {
        $ad = $this->find($id);
        $ad->update(['count_show_ad' => intval($ad->count_show_ad) + 1]);
    }

    public function getRecommended($id)
    {
        $adv = $this->find($id);
        if (!is_null($adv)) {
            return $this->where('advs_advs.slug', '!=', "")
                ->where('advs_advs.status', 'approved')
                ->where('advs_advs.id', '!=', $id)
                ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'))
                ->where('advs_advs.cat1', $adv->cat1)->get();
        }
        return null;
    }

    public function authControl()
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
    }

    public function inStock()
    {
        return $this->is_get_adv && $this->stock;
    }

    public function getCity()
    {
        $cityModel = new CityModel();
        $city = $cityModel->newQuery()->find($this->city);
        return $city ? $city->name : false;
    }

    public function getDistrict()
    {
        $districtModel = new DistrictModel();
        $district = $districtModel->newQuery()->find($this->district);
        return $district ? $district->name : false;
    }

    public function getNeighborhood()
    {
        $neighborhoodModel = new NeighborhoodModel();
        $neighborhood = $neighborhoodModel->newQuery()->find($this->neighborhood);
        return $neighborhood ? $neighborhood->name : false;
    }

    public function getVillage()
    {
        $village = app(VillageRepositoryInterface::class)->find($this->village);
        return $village ? $village->name : false;
    }

    public function expired()
    {
        return $this->finish_at ? $this->finish_at < Carbon::now() : true;
    }

    public function getProductOptionsValues()
    {
        return $this->product_options_value;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function approve()
    {
        $defaultAdPublishTime = setting_value('visiosoft.module.advs::default_published_time');
        $this->update([
            'status' => 'approved',
            'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
            'publish_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function changeStatus($status)
    {
        $this->update(['status' => $status]);
    }
}
