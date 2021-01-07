<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class AdvFormBuilder extends FormBuilder
{
    protected $fields = [
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'price' => [
            'type' => 'anomaly.field_type.text'
        ],
        'standard_price' => [
            'type' => 'anomaly.field_type.text'
        ],
        'advs_desc',
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
        'country' => [
            'class' => 'form-control countryselect'
        ],
        'city' => [
            'class' => 'form-control cityselect'
        ],
        'district' => [
            'class' => 'form-control districtselect'
        ],
        'neighborhood' => [
            'class' => 'form-control neighborhoodselect'
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
	     'product_options_value'
    ];

    protected $category = null;

    protected $rules = [];

    protected $skips = [];

    protected $actions = [];

    protected $buttons = [
        'cancel',
    ];

    protected $options = [];

    protected $sections = [];

    protected $assets = [];
}
