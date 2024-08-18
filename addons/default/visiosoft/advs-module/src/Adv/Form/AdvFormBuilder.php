<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class AdvFormBuilder extends FormBuilder
{
    protected $fields;

    protected $category = null;

    protected $buttons = [
        'cancel',
    ];

    public function __construct(Form $form)
    {
        parent::__construct($form);
        $this->fields = $this->settingFields();
    }

    private function settingFields()
    {
        $requiredFields = setting_value('visiosoft.module.advs::make_all_fields_required');

        $fields = [
            'name' => [
                'translatable' => true,
                'required' => true,
            ],
            'slug' => [
                'unique' => true,
                'required' => true,
            ],
            'price' => [
                'type' => 'anomaly.field_type.text',
                'required' => $requiredFields
            ],
            'advs_desc' => [
                'required' => setting_value('visiosoft.module.advs::is_desc_required')
            ],
            'ad_note' => [
                'type' => 'anomaly.field_type.textarea',
                'translatable' => true,
                'required' => false
            ],
            'cat1',
            'cat2',
            'cat3',
            'cat4',
            'cat5',
            'cat6',
            'cat7',
            'cat8',
            'cat9',
            'cat10',
            'currency',
            'online_payment',
            'stock',
            'min_order_limit',
            'tags',
            'country' => [
                'class' => 'form-control countryselect',
                'required' => setting_value('visiosoft.module.advs::is_country_required')
            ],
            'city' => [
                'class' => 'form-control cityselect',
                'required' => setting_value('visiosoft.module.advs::is_city_required')
            ],
            'district' => [
                'class' => 'form-control districtselect',
                'required' => setting_value('visiosoft.module.advs::is_district_required'),
            ],
            'neighborhood' => [
                'class' => 'form-control neighborhoodselect',
                'required' => setting_value('visiosoft.module.advs::is_neighborhood_required')
            ],
            'village' => [
                'class' => 'form-control villageselect'
            ],
            'map_Val' => [
                'label' => false,
                'class' => 'hidden d-none mapVal'
            ],
            'files',
            'doc_files',
            'popular_adv',
            'adv_day',
            'product_options_value',
            'show_phone_number',
            'seo_title',
            'seo_description'
        ];

        return $fields;
    }
    public function getSkips()
    {
        if (!config("advs::is_changeable_slug",false)){
            return ['slug'];
        }
        
        return array();
    }
}
