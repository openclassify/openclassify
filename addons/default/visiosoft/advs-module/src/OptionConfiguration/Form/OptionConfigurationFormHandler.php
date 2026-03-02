<?php namespace Visiosoft\AdvsModule\OptionConfiguration\Form;

use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;

class OptionConfigurationFormHandler
{
	public function handle(
		OptionConfigurationFormBuilder $builder,
		OptionConfigurationRepositoryInterface $repository
	)
	{
		if (!$builder->canSave()) {
			return;
		}

		$parameters = $builder->getPostData();
		$parameters['parent_adv_id'] = request()->get('ad');

		$option_json = array();

		foreach ($parameters as $key => $parameter_value) {
			if (strpos($key, "option-") === 0) {
				$option_id = substr($key, 7);
				$option_json[$option_id] = $parameter_value;
				unset($parameters[$key]);
			}
		}
		$option_json = ['option_json' => json_encode($option_json)];
		$configration = array_merge($parameters, $option_json);


		$entry = $repository->create($configration);
		$builder->setFormEntry($entry);
	}
}
