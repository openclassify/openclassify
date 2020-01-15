<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\SelectFieldType\Handler\Currencies;
use Anomaly\SettingsModule\Setting\Command\GetSettingValue;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\SettingRepository;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Advs\AdvsCustomFieldsEntryModel;
use Anomaly\Streams\Platform\Support\Currency;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Money\Currencies\CurrencyList;
use Money\Number;
use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\AdvsModule\CustomField\CustomFieldModel;
use Visiosoft\CartsModule\Cart\Command\GetCart;


class AdvModel extends AdvsAdvsEntryModel implements AdvInterface
{
    public function is_enabled($slug)
    {
        $isActive = DB::table('addons_modules')
            ->where('namespace', 'visiosoft.module.' . $slug)
            ->where('installed', 1)
            ->where('enabled', 1)
            ->first();
        if ($isActive == null) {
            return false;
        } else
            return true;
    }

    public function is_enabled_extension($slug)
    {
        $isActive = DB::table('addons_extensions')->where('namespace', 'visiosoft.extension.' . $slug . '_provider')->first();
        if ($isActive == null) {
            return 0;
        } else
            return $isActive->enabled;
    }

    public function is_active()
    {
        $isActive = $this->query()
            ->where('advs_advs.id', $this->id)
            ->where('advs_advs.slug', '!=', "")
            ->first();
        if ($isActive->status != 'approved') {
            return 0;
        } else
            return true;
    }

    public function getAdv($id = null, $nullable_ad = false)
    {
        if ($id != null) {
            if ($nullable_ad)
                return $this->find($id);
            else
                return $this->where('advs_advs.slug', '!=', "")
                    ->find($id);
        }
        if ($nullable_ad)
            return $this->newQuery();
        return $this->where('advs_advs.slug', '!=', "");
    }

    public function userAdv($nullable_ad = false)
    {
        if (Auth::user()->hasRole('admin')) {
            return $this->getAdv(null, $nullable_ad);
        } else {
            return $this->getAdv(null, $nullable_ad)
                ->where('advs_advs.created_by_id', Auth::id());
        }
    }

    public function getAdvByCat($cat_id)
    {
        return $this->userAdv()
            ->where('cat1', $cat_id);
    }

    public function pendingAdvsByUser()
    {
        return $this->userAdv()
            ->where('advs_advs.status', '<>', 'approved')
            ->where('advs_advs.status', '<>', 'declined')
            ->where('advs_advs.status', '<>', 'passive')
            ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'))
            ->orWhereNull('advs_advs.finish_at');
    }

    public function archivedAdvsByUser()
    {
        return $this->userAdv()
            ->where('advs_advs.finish_at', '<', date('Y-m-d H:i:s'))
            ->orWhere('advs_advs.status', 'passive')
            ->WhereNotNull('advs_advs.finish_at');
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

    public function foreignCurrency($currency, $price, $curencies, $isUpdate, $settings)
    {
        $currencies = explode(',', $curencies);
        $foreign_currency = array();

        $client = new Client();

        foreach ($currencies as $currencyIn) {
            if ($currencyIn == $currency) {
                $foreign_currency[$currency] = (int)$price;
            } else {
                try {

                    $url = $currency . "_" . $currencyIn;
                    $freecurrencykey = $settings->value('visiosoft.module.advs::free_currencyconverterapi_key');
                    $response = $client->get('http://free.currencyconverterapi.com/api/v6/convert?q=' . $url . '&compact=y&apiKey=' . $freecurrencykey);

                } catch (RequestException $e) {

                    if ($e->getResponse()->getStatusCode() == '200') {
                        $response = \GuzzleHttp\json_decode($e->getResponse()->getBody()->getContents());
                        $rate = $response->$url->val;
                        $foreign_currency[$currencyIn] = $price * $rate;
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
        return $this->getAdv()->orderBy('count_show_ad', 'desc')->limit(10)->get();
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

    public function addCart($item, $quantity = 1)
    {
        $cart = $this->dispatch(new GetCart());
        $cart->add($item, $quantity);
        return $this->dispatch(new GetCart());
    }


    public function getAdvDetailLinkByModel($object, $type = null)
    {
        if ($type != null) {
            $id = $object->id;
            $seo = str_slug($object->name);
            $seo = str_replace('_', '-', $seo);
            return \route('adv_detail_seo', [$seo, $id]);
        }
        $id = $object->getObject()->id;
        $seo = str_slug($object->getObject()->name);
        $seo = str_replace('_', '-', $seo);
        return \route('adv_detail_seo', [$seo, $id]);
    }

    public function getAdvDetailLinkByAdId($id)
    {
        $adv = $this->find($id);
        if ($adv != null) {
            $id = $adv->id;
            $seo = str_slug($adv->name);
            $seo = str_replace('_', '-', $seo);
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
        $adv = $this->getAdv($id);
        $stock = $adv->stock;
        if ($stock == NULL or $stock == 0) {
            return "false";
        } elseif ($stock < $quantity) {
            return "false";//Adet yetmiyorsa
        } else {
            return "true";
        }

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
}
