<?php namespace Visiosoft\CustomfieldsModule\CustomField;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CustomFieldRepository extends EntryRepository implements CustomFieldRepositoryInterface
{
    protected $model;
    protected $ad;
    private $cfvalueRepository;

    public function __construct(CustomFieldModel $model, AdvModel $ad, CfvalueRepositoryInterface $cfvalueRepository)
    {
        $this->model = $model;
        $this->ad = $ad;
        $this->cfvalueRepository = $cfvalueRepository;
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function deleteCF($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getAdValueByCustomFieldSlug($slug, $ad_id, $get_value = false)
    {
        $cf_field = $this->findBySlug($slug);
        $ad = $this->ad->isAdv($ad_id);

        if ($cf_field and $ad) {
            $cf_json_row = json_decode($ad->cf_json, true);
            if (is_array($cf_json_row) and array_key_exists('cf' . $cf_field->id, $cf_json_row)) {
                $value = $cf_json_row['cf' . $cf_field->id];
                if (($cf_field->type === 'select' || $cf_field->type === 'selectdropdown') && $get_value) {
                    if ($value = $this->cfvalueRepository->find($value)) {
                        return $value->custom_field_value;
                    }

                    return null;
                }

                return $value;
            }
        }
        return null;
    }

    public function getCustomfieldsJoinCategoryWithCategoryID($id = null)
    {
        return $this->customfieldsJoinCategoryWithCategoryID($id)->orderBy('type', 'desc')->get();
    }

    public function customfieldsJoinCategoryWithCategoryID($id = null)
    {
        $query = $this->newQuery()
            ->orderBy('sort_order')
            ->leftJoin('customfields_parent', 'customfields_custom_fields.id', '=', 'customfields_parent.cf_id')
            ->selectRaw("default_customfields_custom_fields.*, default_customfields_parent.cat_id as cat_id");

        if ($id != null) {
            return $query->where('cat_id', $id);
        }

        return $query->where(function ($query) {
            $query->whereNull('cat_id')
                ->orWhere('cat_id', 0);
        });
    }

    public function getSeenCustomFieldsWithCategory($category)
    {
        return $this->customfieldsJoinCategoryWithCategoryID($category)
            ->where('seenList', 1)
            ->get();
    }

    public function getSeenList($advs, $seenList = [], $category = null)
    {
        foreach ($advs as $index => $ad) {
            $findcustomfields = $this->getSeenCustomFieldsWithCategory($category);

            foreach ($findcustomfields as $key => $listseencs) {
                $cfcode = 'cf' . $listseencs->id;

                if ($ad->cf_json) {
                    $cf_json_array = json_decode($ad->cf_json, true);
                    if (count($cf_json_array) && isset($cf_json_array[$cfcode])) {
                        $advs[$index]->$cfcode = $cf_json_array[$cfcode];
                    } else {
                        $advs[$index]->$cfcode = '';
                    }
                }

                $seenList[$cfcode] = $listseencs->name;
            }
        }

        return ['advs' => $advs, 'seenList' => $seenList];
    }

    public function getSeenWithCategory($advs, $seenList, $category)
    {
        if ($category) {
            $category_repository = app(CategoryRepositoryInterface::class);
            $main_categories = $category_repository->getParentCategoryById($category->id);
            $main_categories[] = ['id' => $category->id];

            foreach ($main_categories as $category) {
                $return_param = $this->getSeenList($advs, $seenList, $category['id']);

                $advs = $return_param['advs'];
                $seenList = $return_param['seenList'];
            }
        }

        return ['advs' => $advs, 'seenList' => $seenList];
    }

    public function getCFParamValues($param)
    {
        $rangeCustomFieldParameters = array_filter($param, function ($var) {
            return strpos($var, 'min_cf_') === 0
                || strpos($var, 'max_cf_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $customFieldParameters = array_filter($param, function ($var) {
            return strpos($var, 'cf_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        $rangeCFArray = array();
        foreach ($rangeCustomFieldParameters as $id => $value) {
            if ($value) {
                $cFId = substr($id, 7);
                if ($cF = $this->newQuery()->find($cFId)) {
                    $isMin = strpos($id, 'min_cf_') === 0;
                    if (array_key_exists($cFId, $rangeCFArray)) {
                        $rangeCFArray[$cFId]['value'] = [
                            'min' => $isMin ? $value : $rangeCFArray[$cFId]['value']['min'],
                            'max' => $isMin ? $rangeCFArray[$cFId]['value']['max'] : $value,
                        ];
                    } else {
                        $rangeCFArray[$cFId] = [
                            'type' => $cF->type,
                            'name' => $cF->name,
                            'value' => [
                                $isMin ? 'min' : 'max' => $value,
                            ]
                        ];
                    }
                }
            }
        }
        foreach ($rangeCFArray as $rangeCFId => $rangeValues) {
            $removalLink = array_filter($param, function ($cFParam) use ($rangeCFId) {
                return $cFParam !== "min_cf_$rangeCFId" && $cFParam !== "max_cf_$rangeCFId";
            }, ARRAY_FILTER_USE_KEY);
            $removalLink = fullLink(
                $removalLink,
                \request()->url()
            );

            $rangeCFArray = $this->getRangeTextValues($rangeCFArray, $rangeCFId, $rangeValues, $removalLink);
        }

        $cFArray = array();
        foreach ($customFieldParameters as $id => $value) {
            $cFId = substr($id, 3);

            if ($cF = $this->newQuery()->find($cFId)) {
                $removalLink = array_filter($param, function ($cFParam) use ($cFId) {
                    return $cFParam !== "cf_$cFId";
                }, ARRAY_FILTER_USE_KEY);
                $removalLink = fullLink($removalLink, \request()->url());

                if ($cF->checkType('radio') || $cF->checkType('selecttop') || $cF->checkType('selectdropdown')) {
                    if ($value = is_array($value) ? reset($value) : $value) {
                        if ($cFValue = $this->cfvalueRepository->find($value)) {
                            $cFArray[$cFId] = [
                                'type' => $cF->type,
                                'name' => $cF->name,
                                'value' => [
                                    [
                                        'name' => $cFValue->custom_field_value,
                                        'removalLink' => $removalLink,
                                    ]
                                ]
                            ];
                        }
                    }
                } elseif ($cF->checkType('select') || $cF->checkType('selectimage')) {
                    if ($value) {
                        if ($cF->checkType('selectimage')) {
                            $value = explode(',', $value);
                        }
                        $cFValueArray = array();

                        if (!is_array($value)) {
                            $value = array($value);
                        }

                        foreach ($value as $cFValueId) {
                            if ($cFValueId && $cFValue = $this->cfvalueRepository->find($cFValueId)) {
                                $selectRemovalLink = array_filter($value, function ($cFParam) use ($cFValueId) {
                                    return $cFParam !== $cFValueId;
                                });
                                $removalLink = $param;
                                $removalLink["cf_$cFId"] = !$cF->checkType('selectimage') ?
                                    array_values($selectRemovalLink) :
                                    implode(',', array_values($selectRemovalLink));
                                $removalLink = fullLink($removalLink, \request()->url());

                                $cFValueArray[] = [
                                    'name' => $cFValue->custom_field_value,
                                    'removalLink' => $removalLink,
                                ];
                            }
                        }
                        $cFArray[$cFId] = [
                            'type' => $cF->type,
                            'name' => $cF->name,
                            'value' => $cFValueArray
                        ];
                    }
                }
            }
        }

        return array_merge($rangeCFArray, $cFArray);
    }

    public function getRangeTextValues($rangeCFArray, $rangeCFId, $rangeValues, $removalLink)
    {
        $minValue = array_key_exists('min', $rangeValues['value']) ? $rangeValues['value']['min'] : false;
        $maxValue = array_key_exists('max', $rangeValues['value']) ? $rangeValues['value']['max'] : false;

        $name = '';
        if ($minValue && $maxValue) {
            $name = "$minValue - $maxValue";
        } elseif ($minValue) {
            $name = "$minValue " . trans('visiosoft.module.customfields::field.and_above');
        } elseif ($maxValue) {
            $name = "$maxValue " . trans('visiosoft.module.customfields::field.and_below');
        }

        $rangeCFArray[$rangeCFId]['value'] = [
            [
                'name' => $name,
                'removalLink' => $removalLink,
            ]
        ];

        return $rangeCFArray;
    }

    public function QueryAdsWithCFValue($customfield_slug, $value)
    {
        if ($customfield = $this->findBySlug($customfield_slug)) {
            $jsonQuery = 'JSON_CONTAINS(cf_json, \'"' . $value . '"\', \'$.cf' . $customfield->id . '\')';

            $adv_model = app(AdvRepositoryInterface::class);

            $query = $adv_model->currentAds()
                ->whereRaw($jsonQuery);

            return $query;
        }
    }

    public function getCustomFieldsValueByCfId($id)
    {
        return $this->findBy('id', $id)->cfvalues->all();
    }

    public function getCustomFieldByType($type)
    {
        return $this->newQuery()->where('type', '=', $type)->get();
    }
}
