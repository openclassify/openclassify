<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Visiosoft\AdvsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class AdvFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'price',
        'advs_desc',
        'cat1',
        'cat2',
        'cat3',
        'cat4',
        'cat5',
        'cat6',
        'cat7',
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
        'popular_adv',
        'adv_day'
    ];

    protected $category = null;
    /**
     * Additional validation rules.
     *
     * @var array|string
     */
    protected $rules = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'cancel',
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

    // public function setType(CategoryInterface $category)
    // {
    //     $this->category = $category;

    //     return $this;
    // }
}
