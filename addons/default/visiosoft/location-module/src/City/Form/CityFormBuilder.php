<?php namespace Visiosoft\LocationModule\City\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CityFormBuilder extends FormBuilder
{
    protected $country = null;

    protected $skips = [
        'parent_country_id'
    ];

    protected $buttons = [
        'cancel',
    ];

    public function onSaving()
    {
        $country = $this->getCountry();
        $entry   = $this->getFormEntry();

        if ($country) {
            $entry->parent_country_id = $country;
        }
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    protected $options = [
        'wrapper_view' => 'visiosoft.module.location::admin.form.new-location'
    ];

}
