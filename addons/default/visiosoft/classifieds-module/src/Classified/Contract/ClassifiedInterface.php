<?php namespace Visiosoft\ClassifiedsModule\Classified\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface ClassifiedInterface extends EntryInterface
{
    public function getTransNameAttribute();

    public function is_enabled($slug);

    public function is_enabled_extension($slug);

    public function is_active($id);

    public function getClassified($id = null, $nullable_ad = false, $trashed = false);

    public function userClassified($nullable_ad = false, $checkRole = true);

    public function getClassifiedByCat($cat_id);

    public function pendingClassifiedsByUser();

    public function favsClassifiedsByUser($fav_ids);

    public function myClassifiedsByUser();

	public function foreignCurrency($currency, $price, $isUpdate, $settings, $showMsg);

    public function popularClassifieds();

    public function classifiedsofDay();

    public function statusClassifieds($id, $status);

    public function finish_at_Classifieds($id, $endDate);

    public function publish_at_Classifieds($id);

    public function getLastUserClassified();

    public function getLocationNames($classifieds);

    public function isClassified($id);

    public function addCart($item, $quantity = 1, $name = null);

    public function getClassifiedDetailLinkByModel($object, $type = null);

    public function getClassifiedDetailLinkByAdId($id);

    public function getClassifiedimage($id);

    public function getLatestField($slug);

    public function updateStock($id, $quantity);

    public function stockControl($id, $quantity);

    public function saveCustomField($category_id, $field_id, $name);

    public function customfields();

    public function priceFormat($classified);

    public function AddClassifiedsDefaultCoverImage($classified);

    public function GetClassifiedsDefaultCoverImageByAdId($id);

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

    public function approve();

    public function changeStatus($status);

    public function canEdit();

    public function getCatsIDs();

    public function lastCategory();
}
