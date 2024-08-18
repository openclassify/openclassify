<?php namespace Visiosoft\AdvsModule\Productoption\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\CategoryRepository;

class ProductoptionFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
	protected $fields = [];

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

}
