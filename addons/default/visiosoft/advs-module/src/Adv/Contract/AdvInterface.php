<?php namespace Visiosoft\AdvsModule\Adv\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface AdvInterface extends EntryInterface
{
    public function is_enabled($slug);

    public function is_enabled_extension($slug);

    public function is_active($id);

    public function getAdv($id = null, $nullable_ad = false, $trashed = false);

    public function userAdv($nullable_ad = false, $checkRole = true);

    public function getAdvByCat($cat_id);

    public function pendingAdvsByUser();

    public function favsAdvsByUser($fav_ids);

    public function myAdvsByUser();

    public function foreignCurrency($currency, $price, $isUpdate, $settings);

    public function popularAdvs();

    public function advsofDay();

    public function statusAds($id, $status);

    public function finish_at_Ads($id, $endDate);

    public function publish_at_Ads($id);

    public function getLastUserAdv();

    public function getLocationNames($advs);

    public function isAdv($id);

    public function addCart($item, $quantity = 1, $name = null);

    public function getAdvDetailLinkByModel($object, $type = null);

    public function getAdvDetailLinkByAdId($id);

    public function getAdvimage($id);

    public function getLatestField($slug);

    public function updateStock($id, $quantity);

    public function stockControl($id, $quantity);

    public function saveCustomField($category_id, $field_id, $name);

    public function customfields();

    public function priceFormat($adv);

    public function AddAdsDefaultCoverImage($ad);

    public function GetAdsDefaultCoverImageByAdId($id);

    public function viewed_Ad($id);

    public function getRecommended($id);

    public function authControl();

    public function inStock();

    public function getCity();

    public function getDistrict();

    public function getNeighborhood();

    public function getVillage();

    public function expired();

	public function getProductOptionsValues();

    public function getStatus();
}
