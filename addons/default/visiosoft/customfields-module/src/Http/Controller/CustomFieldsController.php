<?php namespace Visiosoft\CustomfieldsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Support\Str;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

class CustomFieldsController extends PublicController
{
    private $customFieldRepository;

    public function __construct(CustomFieldRepositoryInterface $customFieldRepository)
    {
        parent::__construct();
        $this->customFieldRepository = $customFieldRepository;
    }

    public function isCFAdded($array, $search)
    {
        if (count($array) < 1) {
            return false;
        }

        foreach ($array as $item) {
            if (in_array($search, $item, true)) {
                return true;
            }
        }

        return false;
    }

    public function index($mainCats, $subCats, $categoryId)
    {
        $checkboxes = array();
        $topfields = array();
        $selectRange = array();
        $selectImage = array();
        $selectDropdown = array();
        $ranges = array();
        $radio = array();
        $text = array();
        $datetime = array();

        $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID();
        foreach ($findcustomfields as $findcustomfield) {
            if ($findcustomfield->type !== 'checkboxes' and $findcustomfield->cat_id == null) {
                $cfcheckbox = array();
                $cfcheckbox['id'] = $findcustomfield->id;
                $cfcheckbox['name'] = $findcustomfield->name;
                $cfcheckbox['show_filter'] = $findcustomfield->show_filter;
                if ($findcustomfield->type === 'range') {
                    $ranges[] = $cfcheckbox;
                } else {
                    if ($findcustomfield->cfvalues()->count() > 0) {
                        foreach ($findcustomfield->cfvalues as $v) {
                            $cfcheckbox['values'][$v->id] = $findcustomfield->type === "selectimage" ?
                                ['value' => $v->custom_field_value, 'image' => $v->custom_field_image_id] :
                                $v->custom_field_value;
                        }
                        if ($findcustomfield->type === "selecttop") {
                            $topfields[] = $cfcheckbox;
                        } else if ($findcustomfield->type === "selectdropdown") {
                            $selectDropdown[] = $cfcheckbox;
                        } else if ($findcustomfield->type === "selectrange") {
                            $selectRange[] = $cfcheckbox;
                        } else if ($findcustomfield->type === "selectimage") {
                            $selectImage[] = $cfcheckbox;
                        } else if ($findcustomfield->type === "radio") {
                            $cfcheckbox['values'][""] = trans('visiosoft.module.customfields::field.all');
                            asort($cfcheckbox['values']);
                            $radio[] = $cfcheckbox;
                        } else if (!$this->isCFAdded($checkboxes, $cfcheckbox['id'])) {
                            $checkboxes[] = $cfcheckbox;
                        }
                    } else if ($findcustomfield->type === "text") {
                        $text[] = $cfcheckbox;
                    } else if ($findcustomfield->type === "date-text") {
                        $cfcheckbox['data_date'] = true;
                        $datetime[] = $cfcheckbox;
                    }
                }
            }
        }

        if (!is_null($categoryId)) {
            foreach ($mainCats as $mainCat) {
                $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID($mainCat['id']);
                foreach ($findcustomfields as $findcustomfield) {
                    if ($findcustomfield->type != 'checkboxes') {
                        $cfcheckbox = array();
                        $cfcheckbox['id'] = $findcustomfield->id;
                        $cfcheckbox['name'] = $findcustomfield->name;
                        $cfcheckbox['show_filter'] = $findcustomfield->show_filter;
                        $cfcheckbox['hide_addetail'] = $findcustomfield->hide_addetail;
                        if ($findcustomfield->type == 'range') {
                            $ranges[] = $cfcheckbox;
                        } else {
                            if ($findcustomfield->cfvalues()->count() > 0) {
                                foreach ($findcustomfield->cfvalues as $v) {
                                    $cfcheckbox['values'][$v->id] = $findcustomfield->type == "selectimage" ?
                                        ['value' => $v->custom_field_value, 'image' => $v->custom_field_image_id] :
                                        $v->custom_field_value;
                                }
                                if ($findcustomfield->type == "selecttop") {
                                    $topfields[] = $cfcheckbox;
                                } else if ($findcustomfield->type == "selectdropdown") {
                                    $selectDropdown[] = $cfcheckbox;
                                } else if ($findcustomfield->type == "selectrange") {
                                    $selectRange[] = $cfcheckbox;
                                } else if ($findcustomfield->type == "selectimage") {
                                    $selectImage[] = $cfcheckbox;
                                } else if ($findcustomfield->type == "radio") {
                                    $cfcheckbox['values'][""] = trans('visiosoft.module.customfields::field.all');
                                    asort($cfcheckbox['values']);
                                    $radio[] = $cfcheckbox;
                                } else if (!$this->isCFAdded($checkboxes, $cfcheckbox['id'])) {
                                    $checkboxes[] = $cfcheckbox;
                                }
                            } else if ($findcustomfield->type == "text") {
                                $text[] = $cfcheckbox;
                            } else if ($findcustomfield->type == "date-text") {
                                $cfcheckbox['data_date'] = true;
                                $datetime[] = $cfcheckbox;
                            }
                        }
                    }
                }
            }
        }

        return array('checkboxes' => $checkboxes, 'topfields' => $topfields, 'ranges' => $ranges,
            'radio' => $radio, 'selectRange' => $selectRange, 'selectImage' => $selectImage,
            'selectDropdown' => $selectDropdown, 'text' => $text, 'date-text' => $datetime);
    }

    public function view($adv)
    {
        $cf_array = $adv->cFJSON();
        $features = array();
        $not_null_id = array();
        $findcustomfields = $adv->customfields();

        foreach ($findcustomfields as $fcf) {
            if(!$fcf->hide_addetail){
                $not_null_id[] = $fcf->id;

                if (!$this->isCFAdded($features, $fcf->name)) {
                    $features[] = [
                        'name' => $fcf->name,
                        'slug' => $fcf->slug,
                        'custom_field_value' => $fcf->getClassifiedValue($cf_array),
                        'id' => $fcf->id
                    ];
                }
            }

        }


        $customfields_unselect_checkboxed = array();

        foreach ($adv->toArray() as $key => $field) {
            if (preg_match('/cat\d+/', $key) and !is_null($field)) {
                $customfields_unselect_checkboxed[] = $this->customFieldRepository
                    ->customfieldsJoinCategoryWithCategoryID($field)
                    ->whereNotIn('customfields_custom_fields.id', $not_null_id)
                    ->get();
            }
        }

        foreach ($customfields_unselect_checkboxed as $cutomfieldsCategory) {
            foreach ($cutomfieldsCategory as $customfields) {
                if (!$this->isCFAdded($features, $customfields->name)) {
                    $features[] = [
                        'name' => $customfields->name,
                        'slug' => $customfields->slug,
                        'custom_field_value' => $customfields->getClassifiedValue(),
                        'id' => $customfields->id
                    ];
                }
            }
        }

        $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID();
        foreach ($findcustomfields as $customfields) {
            if (!$this->isCFAdded($features, $customfields->name) && !$customfields->hide_addetail) {
                $features[] = [
                    'name' => $customfields->name,
                    'slug' => $customfields->slug,
                    'custom_field_value' => $customfields->getClassifiedValue()
                ];
            }
        }

        return $features;
    }

    public function create($categories)
    {
        foreach ($categories as $category) {
            if ($cats[$category] != 0) {
                $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID($cats[$category]);
                foreach ($findcustomfields as $findcustomfield) {
                    $field_type = new FieldType;
                    // $field_type->setField('cf__'.$findcustomfield->translations->first()->name);
                    $field_type->setField('cf__' . $findcustomfield->slug);
                    if ($findcustomfield->cfvalues()->count() > 0) {
                        $values = array();
                        foreach ($findcustomfield->cfvalues as $v) {
                            $values[$v->id] = $v->custom_field_value;
                        }
                        $field_type->options = $values;
                        if ($findcustomfield->type == 'select' || $findcustomfield->type == 'selecttop') {
                            if (view()->exists('anomaly.field_type.select::dropdown')) {
                                $custom_fields[] = ['custom_field_input' => view('anomaly.field_type.select::dropdown')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name];
                            }
                        } else if ($findcustomfield->type == 'checkboxes') {
                            if (view()->exists('anomaly.field_type.' . $findcustomfield->type . '::checkboxes')) {
                                $custom_fields[] = ['custom_field_input' => view('anomaly.field_type.' . $findcustomfield->type . '::checkboxes')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name];
                            }
                        } else if ($findcustomfield->type == 'radio') {
                            if (view()->exists('anomaly.field_type.' . $findcustomfield->type . '::radio')) {
                                $custom_fields[] = ['custom_field_input' => view('anomaly.field_type.' . $findcustomfield->type . '::radio')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name];
                            }
                        }
                    } else {
                        if ($findcustomfield->type == 'range') {
                            $findtype = "integer";
                        } else {
                            $findtype = $findcustomfield->type;
                        }
                        $view = 'anomaly.field_type.' . $findtype . '::input';
                        if (view()->exists($view)) {
                            $custom_fields[] = ['custom_field_input' => view($view)->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name];
                        }
                    }
                }
            }
        }
        return $custom_fields;
    }

    public function edit($adv, $categories, $cats)
    {
        $custom_fields = array();
        $cf_array = json_decode($adv['cf_json'], true);
        if (!is_array($cf_array)) {
            $cf_array = array();
        }

        $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID();

        foreach ($categories as $category) {
            if ($cats[$category] != 0) {
                $findcustomfields = $findcustomfields->merge(
                    $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID($cats[$category])
                );
            }
        }

        foreach ($findcustomfields as $findcustomfield) {
            $field_type = new FieldType;
            // $field_type->setField('cf__'.$findcustomfield->translations->first()->name);
            $field_type->setField('cf__' . $findcustomfield->slug);
            $field_type->addAttribute('required', $findcustomfield->required);
            if (array_key_exists('cf' . $findcustomfield->id, $cf_array)) {
                $field_type->setValue($cf_array['cf' . $findcustomfield->id]);
                $field_type->key = $cf_array['cf' . $findcustomfield->id];
            }
            if ($findcustomfield->cfvalues()->count() > 0) {
                $values = array();
                foreach ($findcustomfield->cfvalues as $v) {
                    $key = $findcustomfield->type == 'selectrange' ? $v->custom_field_value : $v->id;
                    $values[$key] = $v->custom_field_value;
                }
                $field_type->options = $values;
                if ($findcustomfield->type == 'select'
                    || $findcustomfield->type == 'selecttop'
                    || $findcustomfield->type == 'selectdropdown'
                    || $findcustomfield->type == 'selectrange'
                    || $findcustomfield->type == 'selectimage') {
                    if (view()->exists('anomaly.field_type.select::dropdown')) {
                        if (!$this->isCFAdded($custom_fields, $findcustomfield->name)) {
                            $field_type->setPlaceholder('visiosoft.module.customfields::field.select.name');

                            $custom_fields[] = [
                                'type' => $findcustomfield->type,
                                'custom_field_input' => view('anomaly.field_type.select::dropdown')->with('field_type', $field_type)->render(),
                                'custom_field_label' => $findcustomfield->name,
                                'custom_field_slug' => $findcustomfield->slug,
                                'custom_field_value_id' => $findcustomfield->id,
                                'sort_order' => $findcustomfield->sort_order,
                                'field_types' => $findcustomfield->cfvalues->toArray(),
                                'field_type' => $field_type
                            ];
                        }
                    }
                } else if ($findcustomfield->type == 'checkboxes') {
                    if (view()->exists('anomaly.field_type.' . $findcustomfield->type . '::checkboxes')) {
                        if (!$this->isCFAdded($custom_fields, $findcustomfield->name))
                            $custom_fields[] = ['type' => $findcustomfield->type, 'custom_field_input' => view('anomaly.field_type.' . $findcustomfield->type . '::checkboxes')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name, 'custom_field_slug' => $findcustomfield->slug, 'sort_order' => $findcustomfield->sort_order];
                    }
                } else if ($findcustomfield->type == 'radio') {
                    if (view()->exists('anomaly.field_type.select::radio')) {
                        if (!$this->isCFAdded($custom_fields, $findcustomfield->name))
                            $custom_fields[] = ['type' => $findcustomfield->type, 'custom_field_input' => view('anomaly.field_type.select::radio')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name, 'custom_field_slug' => $findcustomfield->slug, 'sort_order' => $findcustomfield->sort_order];
                    }
                }
            } else {
                if ($findcustomfield->type == 'range') {
                    $findtype = "integer";
                } else if ( $findcustomfield->type == 'date-text' ){
                    $findtype = "text";
                }else {
                    $findtype = $findcustomfield->type;
                }
                $view = 'anomaly.field_type.' . $findtype . '::input';
                if (view()->exists($view)) {
                    if ($findcustomfield->config) {
                        $cf_field_config = json_decode($findcustomfield->config, true);
                        if (isset($cf_field_config['config_min'])) {
                            $field_type->configSet('min', $cf_field_config['config_min']);
                        }
                        if (isset($cf_field_config['config_max'])) {
                            $field_type->configSet('max', $cf_field_config['config_max']);
                        }
                    }
                    if (!$this->isCFAdded($custom_fields, $findcustomfield->name))
                        $custom_fields[] = [
                            'type' => $findcustomfield->type,
                            'custom_field_input' => view($view)->with('field_type', $field_type)->render(),
                            'custom_field_label' => $findcustomfield->name,
                            'custom_field_slug' => $findcustomfield->slug,
                            'sort_order' => $findcustomfield->sort_order,
                            'data_date' => $findcustomfield->type == 'date-text',
                            'field_types' => $findcustomfield->cfvalues->toArray(),
                        ];
                }
            }
        }

        foreach ($custom_fields as $key => $custom_field){
            if (!isset($custom_field['type'])){
                unset($custom_fields[$key]);
            }
        }
        usort($custom_fields, function ($a, $b) {
            return $a['sort_order'] > $b['sort_order'];
        });

        if (is_extension_installed('visiosoft.extension.selected_cf')) {
            $custom_fields = app('Visiosoft\SelectedCfExtension\SelectedCf\SelectedCfRepository')
                ->search($custom_fields,$cats);
        }

        return $custom_fields;
    }

    public function filterSearch($customParameters, $param, $query)
    {
        foreach ($param as $para => $value) {
            if (substr($para, 4, 3) === "cf_") {
                $id = substr($para, 7);
                $minmax = substr($para, 0, 3);
                if ($minmax == 'min') {
                    $num = $param[$minmax . '_cf_' . $id];
                    if ($num != "") {
                        $int = (int)$num;
                        $query = $query->where('cf_json->cf'.$id,'>=',$int);
                    }
                }
                if ($minmax == 'max') {
                    $num = $param[$minmax . '_cf_' . $id];
                    if ($num != "") {
                        $int = (int)$num;
                        $query = $query->where('cf_json->cf'.$id,'<=',$int);
                    }
                }
            }
        }

        foreach ($customParameters as $key => $customParameter) {
            if ($customParameter['value'] == "" or $customParameter['value'][0] == "") {
                unset($customParameters[$key]);
            }
        }
        $customParameters = array_values($customParameters);

        foreach ($customParameters as $key => $customItem) {
            $isDate = explode("_",$customItem['id'],2);
            $currentField = explode(".",(explode("_",$customItem['id'],2)[0]) ,2)[1];
            if (isset($isDate[1]) && $isDate[1] == 'date') {
                $firstDate = substr($customItem['value'],0,10);
                $secondDate = substr($customItem['value'],-10);
                $query->whereBetween("cf_json->".$currentField,[$firstDate,$secondDate]);
            } else {
                $query->where("cf_json->".$currentField,'=',$customItem['value']);
            }
        }

        $sortBy = $param['sort_by'] ?? null;
        if (Str::startsWith($sortBy, 'cf_')) {
            $sortBy = explode('_', $sortBy);
            $id = $sortBy[1];
            $dir = $sortBy[2];

            if (($cF = $this->customFieldRepository->find($id)) && $cF->isSortable()) {
                $query = $query->orderBy("cf_json->cf".$id, $dir);
            }
        }

        return $query;
    }

    public function store($adv, $request)
    {
        $jsonVal = [];

        // Delete Old
        for ($i = 1; $i < 10; $i++) {
            $cat = 'cat' . $i;
            if ($request->$cat != 0) {
                $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID($request->$cat);
                foreach ($findcustomfields as $findcustomfield) {
                    $cs_name = 'cf__' . $findcustomfield->slug;
                    $cf_id = "cf" . $findcustomfield->id;
                    if ($request->$cs_name) {
                        $jsonVal[$cf_id] = $request->$cs_name;
                    }
                }
            }
        }

        $findcustomfields = $this->customFieldRepository->getCustomfieldsJoinCategoryWithCategoryID();
        foreach ($findcustomfields as $findcustomfield) {
            $cs_name = 'cf__' . $findcustomfield->slug;
            $cf_id = "cf" . $findcustomfield->id;
            if ($request->$cs_name) {
                $jsonVal[$cf_id] = $request->$cs_name;
            }
        }

        $adv->cf_json = json_encode($jsonVal);
        $adv->save();
    }

    public function whereJsonContains($query, $column, $value)
    {
        return $query->whereRaw('JSON_CONTAINS(cf_json, \'"' . $value . '"\', \'$.cf' . $column . '\')')->get();
    }

    public function getCfValue(CfvalueRepositoryInterface $cfvalueRepository, $cf)
    {
        $cfValue = $cfvalueRepository->newQuery()->where('custom_field_id', $cf)->get();
        return $this->response->json($cfValue);
    }
}
