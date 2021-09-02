<?php namespace Visiosoft\ClassifiedsModule\Classified\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface ClassifiedRepositoryInterface extends EntryRepositoryInterface
{
    public function searchClassifieds(
        $type, $param = null, $customParameters = null,
        $limit = null, $category = null, $city = null, $paginate = true
    );

    public function softDeleteClassified($id);

    public function getListItemClassified($id);

    public function addAttributes($classifieds);

    public function getLocationNames($classified);

    public function getCatNames($classified);

    public function findByIDAndSlug($id, $slug);

    public function cover_image_update($classified);

    public function getRecommendedClassifieds($id);

    public function getLastAd($id);

    public function getClassifiedArray($id);

    public function getQuantity($quantity, $type, $item);

    public function findByIds($ids);

    public function latestClassifieds();

	public function bestsellerClassifieds($catId= null, $limit = 10);

    public function getByCat($catID, $level = 1, $limit = 20);

    public function getClassifiedsCountByCategory($catID, $level = 1);

    public function getCategoriesWithAdID($id);

    public function extendClassifieds($allClassifieds, $isAdmin = false);

    public function getByUsersIDs($usersIDs, $status = 'approved', $withDraft = false);

    public function getPopular();

	public function getName($id);

    public function approveClassifieds($classifiedsIDs);

    public function getUserClassifieds($userID = null, $status = "approved");

    public function currentClassifieds();
}
