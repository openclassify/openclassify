<?php namespace Visiosoft\AdvsModule\OptionConfiguration;

use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsOptionConfigurationEntryModel;

class OptionConfigurationModel extends AdvsOptionConfigurationEntryModel implements OptionConfigurationInterface
{
	public function getName($id)
	{
		$configuration = $this->find($id);
		$adv = $this->adv_model->find($configuration->parent_adv_id);
		dd($adv);
	}
}
