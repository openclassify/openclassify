<?php namespace Visiosoft\LocationModule\District\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class DistrictFormBuilder extends FormBuilder
{
    protected $city = null;

    protected $skips = [
        'parent_city_id'
    ];

    protected $buttons = [
        'cancel',
    ];

    public function onSaving()
    {
        $city  = $this->getCity();
        $entry = $this->getFormEntry();

        if ($city) {
            $entry->parent_city_id = $city;
        }
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    protected $options = [
        'wrapper_view' => 'visiosoft.module.location::admin.form.new-location'
    ];

}
