<?php namespace Visiosoft\AdvsModule\Adv\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface AdvRepositoryInterface extends EntryRepositoryInterface
{
    public function findById($id);

    public function searchAdvs($type, $param = null, $customParameters = null, $limit = null);

    public function softDeleteAdv($id);

    public function getListItemAdv($id);

    public function addAttributes($advs);

    public function getLocationNames($adv);

    public function getCatNames($adv);

    public function cover_image_update($adv);

    public function delete_empty_advs();

    public function getRecommendedAds($id);

    public function getLastAd($id);

    public function getAdvArray($id);

    public function getQuantity($quantity, $type, $item);

    public function findByIds($ids);

    public function latestAds();

    public function getCategoriesWithAdID($id);

}
