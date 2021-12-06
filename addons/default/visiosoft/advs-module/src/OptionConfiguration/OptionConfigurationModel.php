<?php namespace Visiosoft\AdvsModule\OptionConfiguration;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsOptionConfigurationEntryModel;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class OptionConfigurationModel extends AdvsOptionConfigurationEntryModel implements OptionConfigurationInterface
{
    protected $appends = [
        'option_name'
    ];

    public function getOptionNameAttribute()
    {
        return $this->getName(false);
    }

    public function getName($add_name = true)
    {
        if ($adv = app(AdvRepositoryInterface::class)->find($this->parent_adv_id)) {
            $configurations_item = json_decode($this->option_json, true);
            $option_group_value = "";

            foreach ($configurations_item as $option_id => $value) {
                $value_entry = app(ProductoptionsValueRepositoryInterface::class)->find($value);
                $option_group_value .= " " . $value_entry->getName();
            }

            $name = trim($option_group_value, ' ');

            $name .= ' ' . $this->custom_option;

            return ($add_name) ? $adv->name . ' | ' . $name : $name;
        }
        return null;
    }

    public function stockControl($id, $quantity)
    {
        $conf = $this->newQuery()->find($id);
        $stock = $conf->stock;

        if ($stock === NULL || $stock === 0) {
            return 0;
        }

        if ($stock < $quantity) {
            return 0;
        }

        return 1;
    }
}
