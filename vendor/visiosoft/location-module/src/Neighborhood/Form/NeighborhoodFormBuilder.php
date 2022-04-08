<?php namespace Visiosoft\LocationModule\Neighborhood\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class NeighborhoodFormBuilder extends FormBuilder
{
    protected $district = null;

    protected $skips = [
        'parent_district_id'
    ];

    protected $buttons = [
        'cancel',
    ];

    public function onSaving()
    {
        $district = $this->getDistrict();
        $entry    = $this->getFormEntry();

        if ($district) {
            $entry->parent_district_id = $district;
        }
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setDistrict($district = null)
    {
        $this->district = $district;

        return $this;
    }

    protected $options = [
        'wrapper_view' => 'visiosoft.module.location::admin.form.new-location'
    ];

}
