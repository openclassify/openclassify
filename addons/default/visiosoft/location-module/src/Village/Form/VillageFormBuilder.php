<?php namespace Visiosoft\LocationModule\Village\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class VillageFormBuilder extends FormBuilder
{
    protected $neighborhood = null;

    protected $skips = [
        'parent_neighborhood_id'
    ];

    protected $buttons = [
        'cancel',
    ];

    public function onSaving()
    {
        $neighborhood = $this->getNeighborhood();
        $entry        = $this->getFormEntry();

        if ($neighborhood) {
            $entry->parent_neighborhood_id = $neighborhood;
        }
    }

    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    public function setNeighborhood($neighborhood = null)
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    protected $options = [
        'wrapper_view' => 'visiosoft.module.location::admin.form.new-location'
    ];
}
