<?php namespace Visiosoft\AdvsModule\Adv;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Message\MessageBag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\AdvsModule\OptionConfiguration\OptionConfigurationModel;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\CartsModule\Cart\Command\GetCart;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;

class AdvModel extends AdvsAdvsEntryModel implements AdvInterface
{
    protected $appends = [
        'detail_url',
        'currency_price',
        'category1',
	    'currency_standard_price',
	    'category2',
        'thumbnail',
        'video',
    ];

    protected $cascades = [
        'configurations',
    ];

    public function getDetailUrlAttribute()
    {
        // Checking for slug
        if ($this->attributes) {
            return $this->getAdvDetailLinkByModel($this, 'list');
        }
    }

    public function configurations()
    {
        return $this->hasMany(
            OptionConfigurationModel::class,
            'parent_adv_id'
        );
    }

    public function getConfigurations()
    {
        return $this->getAttribute('configurations');
    }

    public function getCurrencyPriceAttribute()
    {
        return app(Currency::class)->format($this->price, $this->currency);
    }

	public function getCurrencyStandardPriceAttribute()
	{
		if ($this->standard_price > $this->price) {
			return app(Currency::class)->format($this->standard_price, $this->currency);
		}
		return null;
	}

    public function getCategory1Attribute()
    {
        return $this->hasMany('Visiosoft\CatsModule\Category\CategoryModel', 'id', 'cat1')->first();
    }

    public function getCategory2Attribute()
    {
        return $this->hasMany('Visiosoft\CatsModule\Category\CategoryModel', 'id', 'cat1')->first();
    }

    public function getThumbnailAttribute()
    {
        if ($this->cover_photo == null) {
            return $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/no-image.png', 'img'))->url();
        }

        return url($this->cover_photo);
    }

    public function getVideoAttribute()
    {
        if (is_module_installed('visiosoft.module.cloudinary')) {
            $url = app('Visiosoft\CloudinaryModule\Http\Controller\VideoController')->getVideoUrl($this->id);
            $thumbnail = str_replace('mp4', 'jpg', $url);

            return [
                'url' => $url,
                'thumbnail' => $thumbnail,
            ];
        }

        return null;
    }

    public function getTransNameAttribute()
    {
        if (is_null($this->name)) {
            $ad = DB::table('advs_advs')
                ->join('advs_advs_translations', 'advs_advs.id', '=', 'entry_id')
                ->select('name')
                ->where('advs_advs.id', $this->id)
                ->whereNotNull('name')
                ->first();

            return $ad ? $ad->name : '-';
        }

        return $this->name;
    }

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
        }

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

        if ($id !== null) {
            if ($nullable_ad) {
                return $query->find($id);
            } else {
                return $query->where('advs_advs.slug', '!=', "")->find($id);
            }
        }

        if ($nullable_ad) {
            return $query->newQuery();
        }

        return $query->where('advs_advs.slug', '!=', "");
    }

    public function userAdv($nullable_ad = false, $checkRole = true)
    {
        if ($user = Auth::user() and $user->hasRole('admin') && $checkRole) {
            return $this->getAdv(null, $nullable_ad);
        }

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
            $locale = config('app.locale', config('streams::locales.default'));
            $country_id = !empty($adv->country_id)  ? $adv->country_id : 0;
            $city_id = !empty($adv->city) ? $adv->city : 0;
            $district_id = !empty($adv->district) ? $adv->district : 0;

            $q = collect(DB::select("
                    SELECT country.abv as country_abv, country_trans.name as country_name,
                        (SELECT name FROM default_location_cities_translations as city_trans WHERE city_trans.id = " . $city_id . " AND city_trans.locale = '" . $locale . "') as city_name,
                        (SELECT name FROM default_location_districts_translations as district_trans WHERE district_trans.id = " . $district_id . " AND district_trans.locale = '" . $locale . "') as district_name
                    FROM default_location_countries AS country
                    JOIN default_location_countries_translations AS country_trans on country.id = country_trans.entry_id WHERE country.id = " . $country_id . " and country_trans.locale = '" . $locale . "'
                    "))->first();

            if (is_object($q)) {
                foreach ($q as $key => $value){
                    $adv->setAttribute($key, $value);
                }
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
        if ($adv = $this->getAdv($id)) {
            $stock = $adv->stock;

            if ($stock and $stock >= $quantity) {
                return 1;
            }
        }
        return 0;
    }

    public function customfields()
    {
        if ($cFs = (array) json_decode($this->cf_json)) {
            $cFs = array_keys($cFs);

            $cFIDs = array_map(function ($cF) {
                return ltrim($cF, 'cf');
            }, $cFs);

            return app(CustomFieldRepositoryInterface::class)
                ->newQuery()
                ->whereIn('id', $cFIDs)
                ->get();
        }

        return [];
    }

    public function cFJSON()
    {
        return json_decode($this->cf_json, true);
    }

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

    public function currentAds() {
    	return $this->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
		    ->where('status', '=', 'approved')
		    ->where('slug', '!=', '')
		    ->orderBy('publish_at', 'desc');
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

    public function canEdit()
    {
        return $this->created_by_id == \auth()->id() || \auth()->user()->isAdmin();
    }

    public function getCatsIDs()
    {
        $attr = $this->getAttributes();
        return array_filter(
            $attr,
            function ($key) use ($attr) {
                return Str::startsWith($key, 'cat') && $attr[$key];
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    public function lastCategory()
    {
        if (!$catsIDs = $this->getCatsIDs()) {
            return null;
        }

        $lastCatID = end($catsIDs);

        if (!$lastCat = app(CategoryRepositoryInterface::class)->find($lastCatID)) {
            return null;
        }

        return $lastCat;
    }

    public function scopeCurrent($query)
    {
        return $query
            ->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
            ->where('status', '=', 'approved')
            ->where('slug', '!=', '');
    }

    public function setConfig($key, $value)
    {
        $config = $this->config;
        $config = $config ? (array) json_decode($config) : [];

        $config[$key] = $value;

        $this->config = json_encode($config);
        $this->save();
    }

    public function getConfig($key)
    {
        $config = $this->config;
        $config = $config ? (array) json_decode($config) : [];

        return $config[$key] ?? null;
    }
}
