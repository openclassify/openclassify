<?php namespace Visiosoft\CustomfieldsModule\CustomField\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldModel;

class getCustomFields
{
    private $slug;
    private $placeholder;
    private $view;

    public function __construct($slug, $placeholder, $view = true)
    {
        $this->slug = $slug;
        $this->placeholder = $placeholder;
        $this->view = $view;
    }

    public function handle(CustomFieldModel $customFieldModel)
    {

        $cf_array = array();

        if ($findcustomfield = $customFieldModel::query()->where('slug', $this->slug)->first()) {

            if (!$this->view) {
                return $findcustomfield;
            }

            $field_type = new FieldType;
            // $field_type->setField('cf__'.$findcustomfield->translations->first()->name);
            $field_type->setField('cf_' . $findcustomfield->id);
            if (array_key_exists('cf' . $findcustomfield->id, $cf_array)) {
                $field_type->setValue($cf_array['cf' . $findcustomfield->id]);
                $field_type->key = $cf_array['cf' . $findcustomfield->id];
            }
            $values = array();
            foreach ($findcustomfield->cfvalues as $v) {
                $values[$v->id] = $v->custom_field_value;
            }

            $field_type->options = $values;
            if ($findcustomfield->type == 'select' || $findcustomfield->type == 'selecttop') {
                if (view()->exists('anomaly.field_type.select::dropdown')) {
                    $field_type->setPlaceholder($this->placeholder);
                    $custom_field = ['type' => $findcustomfield->type, 'custom_field_input' => view('anomaly.field_type.select::dropdown')->with('field_type', $field_type)->render(), 'custom_field_label' => $findcustomfield->name];
                }

                return $custom_field['custom_field_input'];
            }

            return $findcustomfield;
        }
        return null;
    }
}
