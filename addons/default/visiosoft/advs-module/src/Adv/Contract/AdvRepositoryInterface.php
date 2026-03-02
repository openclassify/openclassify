<?php namespace Visiosoft\AdvsModule\Adv\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface AdvRepositoryInterface extends EntryRepositoryInterface
{
    public function searchAdvs(
        $type, $param = null, $customParameters = null,
        $limit = null, $category = null, $city = null, $paginate = true
    );

    public function softDeleteAdv($id);

    public function getListItemAdv($id);

    public function addAttributes($advs);

    public function getLocationNames($adv);

    public function getCatNames($adv);

    public function findByIDAndSlug($id, $slug);

    public function cover_image_update($adv);

    public function getRecommendedAds($id);

    public function getLastAd($id);

    public function getAdvArray($id);

    public function getQuantity($quantity, $type, $item);

    public function findByIds($ids);

    public function latestAds();

    public function latestAdsWithout($keyword, $value);

	public function bestsellerAds($catId= null, $limit = 10);

    public function getByCat($catID, $level = 1, $limit = 20);

    public function getAdsCountByCategory($catID, $level = 1);

    public function getCategoriesWithAdID($id);

    public function extendAds($allAds, $isAdmin = false);

    public function getByUsersIDs($usersIDs, $status = 'approved', $withDraft = false);

    public function getPopular();

	public function getName($id);

    public function approveAds($adsIDs);

    public function getUserAds($userID = null, $status = "approved");

    public function currentAds();

    public function expiredAds();

    public function findByCFJSON($key, $value);

    public function uploadImage();

    public function getStockReport();

    public function getAllClassifiedsCount();

    public function getCurrentClassifiedsCount();

    public function getUnexplainedClassifiedsReport();

    public function getNoImageClassifiedsReport();

    public function getClassifiedsByCoordinates($lat, $lng, $distance = 50);

    public function getClassifiedsByCatsIDsAndLevels($categories, $limit = 10);

    public function getSimilarAd($id,array $userIds,$limit = 10);

    public function restoreMultiple(array $ids);
}
