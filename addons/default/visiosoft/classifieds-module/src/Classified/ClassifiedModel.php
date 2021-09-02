<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsCustomFieldsEntryModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedInterface;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsClassifiedsEntryModel;
use Visiosoft\ClassifiedsModule\OptionConfiguration\OptionConfigurationModel;
use Visiosoft\ClassifiedsModule\Support\Command\Currency;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\CartsModule\Cart\Command\GetCart;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;

class ClassifiedModel extends ClassifiedsClassifiedsEntryModel implements ClassifiedInterface
{
    protected $appends = [
        'detail_url',
        'currency_price',
        'category1',
	    'currency_standard_price',
	    'category2',
        'thumbnail',
    ];

    protected $cascades = [
        'configurations',
    ];

    public function getDetailUrlAttribute()
    {
        // Checking for slug
        if($this->attributes)
        {
            return $this->getClassifiedDetailLinkByModel($this, 'list');
        }
    }

    public function configurations()
    {
        return $this->hasMany(
            OptionConfigurationModel::class,
            'parent_classified_id'
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
        } else {
            return url($this->cover_photo);
        }
    }

    public function getTransNameAttribute()
    {
        if (is_null($this->name)) {
            $classified = DB::table('classifieds_classifieds')
                ->join('classifieds_classifieds_translations', 'classifieds_classifieds.id', '=', 'entry_id')
                ->select('name')
                ->where('classifieds_classifieds.id', $this->id)
                ->whereNotNull('name')
                ->first();

            return $classified ? $classified->name : '-';
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
        } else
            return $isActive->enabled;
    }

    public function is_active($id)
    {
        $isActive = $this->query()
            ->where('classifieds_classifieds.id', $id)
            ->where('classifieds_classifieds.slug', '!=', "")
            ->first();
        if ($isActive->status != 'approved') {
            return 0;
        }
        return 1;
    }

    public function getClassified($id = null, $nullable_ad = false, $trashed = false)
    {
        $query = $this::query();

        if ($trashed) {
            $query = $this::withTrashed();
        }

        if ($id !== null) {
            if ($nullable_ad) {
                return $query->find($id);
            } else {
                return $query->where('classifieds_classifieds.slug', '!=', "")
                    ->find($id);
            }
        }
        if ($nullable_ad) {
            return $query->newQuery();
        }
        return $query->where('classifieds_classifieds.slug', '!=', "");
    }

    public function userClassified($nullable_ad = false, $checkRole = true)
    {
        if ($user = Auth::user() and $user->hasRole('admin') && $checkRole) {
            return $this->getClassified(null, $nullable_ad);
        }

        return $this->getClassified(null, $nullable_ad)
            ->where('classifieds_classifieds.created_by_id', Auth::id());
    }

    public function getClassifiedByCat($cat_id)
    {
        return $this->userClassified()
            ->where('cat1', $cat_id);
    }

    public function pendingClassifiedsByUser()
    {
        return $this->userClassified()
            ->where(function ($query) {
                $query->where('classifieds_classifieds.status', '<>', 'approved');
                $query->orWhere('classifieds_classifieds.finish_at', '<', date('Y-m-d H:i:s'));
            });
    }


    public function favsClassifiedsByUser($fav_ids)
    {
        return $this->userClassified()
            ->whereIn('classifieds_classifieds.id', $fav_ids)//Array favs id
            ->where('classifieds_classifieds.status', 'approved');
    }

    public function myClassifiedsByUser()
    {
        return $this->userClassified()
            ->where('classifieds_classifieds.status', 'approved')
            ->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'));
    }

    public function foreignCurrency($currency, $price, $isUpdate, $settings, $showMsg = true)
    {
        $currencies = setting_value('visiosoft.module.classifieds::enabled_currencies');
        $messages = app(MessageBag::class);
        $foreign_currency = array();

        foreach ($currencies as $currencyIn) {
            if ($currencyIn == $currency) {
                $foreign_currency[$currency] = (int)$price;
            } else {
                try {
                    $url = $currency . "_" . $currencyIn;
                    $freeCurrencyKey = $settings->value('visiosoft.module.classifieds::free_currencyconverterapi_key');

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
            $classified = ClassifiedsClassifiedsEntryModel::query()->where('classifieds_classifieds.id', $isUpdate)->first();
        } else {
            $classified = ClassifiedsClassifiedsEntryModel::query()->where('classifieds_classifieds.created_by_id', auth()->user()->id)->latest()->first();
        }
        $classified->foreign_currencies = json_encode($foreign_currency);
        $classified->save();
    }

    public function popularClassifieds()
    {
        return $this->getClassified()->where('status', 'approved')
            ->orderBy('count_show_ad', 'desc')->limit(10)->get();
    }

    public function classifiedsofDay()
    {
        return $this->getClassified()->where('classified_day', 1)->paginate(9);
    }

    public function statusClassifieds($id, $status)
    {
        $this->getClassified($id)->update(['status' => $status]);
        return $status;

    }

    public function finish_at_Classifieds($id, $endDate)
    {
        $date = date('Y-m-d H:i:s');
        $this->getClassified($id)->update(['finish_at' => date('Y-m-d H:i:s',
            strtotime($date . ' + ' . $endDate . ' day'))]);
    }

    public function publish_at_Classifieds($id)
    {
        $date = date('Y-m-d H:i:s');
        $this->getClassified($id)->update(['publish_at' => $date]);
    }

    public function getLastUserClassified()
    {
        return $this->userClassified()
            ->orderByDesc('id')
            ->first();
    }

    public function getLocationNames($classifieds)
    {
        foreach ($classifieds as $classified) {
            $country = CountryModel::query()->where('location_countries.id', $classified->country_id)->first();
            $city = CityModel::query()->where('location_cities.id', $classified->city)->first();

            if ($country != null) {
                $classified->setAttribute('country_name', $country->name);
                $classified->setAttribute('country_abv', $country->abv);
            }
            if ($city != null) {
                $classified->setAttribute('city_name', $city->name);
            }
        }
        return $classifieds;
    }


    public function isClassified($id)
    {
        return $this->getClassified()->where('classifieds_classifieds.id', $id)->first();
    }

    public function addCart($item, $quantity = 1, $name = null)
    {
        $cart = $this->dispatch(new GetCart());
        $cart->add($item, $quantity, $name);
        return $this->dispatch(new GetCart());
    }


    public function getClassifiedDetailLinkByModel($object, $type = null)
    {
        if ($type != null) {
            $id = $object->id;
            $seo = $object->slug;
            return \route('classified_detail_seo', [$seo, $id]);
        }
        $id = $object->getObject()->id;
        $seo = $object->getObject()->slug;
        return \route('classified_detail_seo', [$seo, $id]);
    }

    public function getClassifiedDetailLinkByAdId($id)
    {
        $classified = $this->find($id);
        if ($classified != null) {
            $id = $classified->id;
            $seo = $classified->slug;
            return \route('classified_detail_seo', [$seo, $id]);
        }
    }

    public function getClassifiedimage($id)
    {
        return $this->getClassified($id)->files;
    }

    public function getLatestField($slug)
    {
        return DB::table('streams_fields')->where('slug', $slug)->first();
    }

    public function updateStock($id, $quantity)
    {
        $classified = $this->getClassified($id);
        $oldStock = $classified->stock;
        $newStock = $oldStock - $quantity;
        $classified->update(['stock' => $newStock]);
    }

    public function stockControl($id, $quantity)
    {
        if ($classified = $this->getClassified($id)) {
            $stock = $classified->stock;

            if ($stock and $stock >= $quantity) {
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

        if (ClassifiedsCustomFieldsEntryModel::create($all)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            abort(404);
        }
    }

    public function customfields()
    {
        return $this->hasMany('Visiosoft\CustomfieldsModule\CustomFieldClassified\CustomFieldClassifiedModel', 'parent_classified_id', 'id');
    }

    // public function getCustomFieldEditId($id) {
    //     $custom_field = ClassifiedsCustomFieldsEntryModel::query()->where('classifieds_custom_fields.id', $id)->first();
    //     return DB::table('streams_assignments')->where('field_id', $custom_field->field_id)->first();
    // }

    public function priceFormat($classified)
    {
        return number_format($classified->price, "2", ",", str_replace('&#160;', ' ', "."));
    }

    public function AddClassifiedsDefaultCoverImage($classified)
    {
        if ($classified->cover_photo == null) {
            $classified->cover_photo = $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/no-image.png', 'img'))->url();
        } else {
            $classified->cover_photo = url($classified->cover_photo);
        }
        return $classified;
    }

    public function GetClassifiedsDefaultCoverImageByAdId($id)
    {
        $classified = $this->find($id);
        if ($classified == null or $classified->cover_photo == null) {
            $cover_photo = $this->dispatch(new MakeImageInstance('visiosoft.theme.base::images/no-image.png', 'img'))->url();
        } else {
            $cover_photo = url($classified->cover_photo);
        }
        return $cover_photo;
    }

    public function viewed_Ad($id)
    {
        $classified = $this->find($id);
        $classified->update(['count_show_ad' => intval($classified->count_show_ad) + 1]);
    }

    public function getRecommended($id)
    {
        $classified = $this->find($id);
        if (!is_null($classified)) {
            return $this->where('classifieds_classifieds.slug', '!=', "")
                ->where('classifieds_classifieds.status', 'approved')
                ->where('classifieds_classifieds.id', '!=', $id)
                ->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'))
                ->where('classifieds_classifieds.cat1', $classified->cat1)->get();
        }
        return null;
    }

    public function authControl()
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
    }

    public function currentClassifieds() {
    	return $this->whereDate('finish_at', '>=', date("Y-m-d H:i:s"))
		    ->where('status', '=', 'approved')
		    ->where('slug', '!=', '')
		    ->orderBy('publish_at', 'desc');
    }

    public function inStock()
    {
        return $this->is_get_classified && $this->stock;
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
        $defaultAdPublishTime = setting_value('visiosoft.module.classifieds::default_published_time');
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
}
