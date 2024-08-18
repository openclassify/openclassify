<?php namespace Visiosoft\CustomfieldsModule\CustomField\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CustomFieldRepositoryInterface extends EntryRepositoryInterface
{
    public function findBySlug($slug);

    public function deleteCF($id);

    public function getAdValueByCustomFieldSlug($slug, $ad_id, $get_value = false);

    public function getCFParamValues($param);

    public function getCustomfieldsJoinCategoryWithCategoryID($id = null);

    public function customfieldsJoinCategoryWithCategoryID($id = null);

    public function getSeenCustomFieldsWithCategory($category);

    public function getSeenList($advs, $seenList = [], $category = null);

    public function getSeenWithCategory($advs, $seenList, $category);

    public function getRangeTextValues($rangeCFArray, $rangeCFId, $rangeValues, $removalLink);

    public function QueryAdsWithCFValue($customfield_slug, $value);

    public function getCustomFieldsValueByCfId($id);
}
