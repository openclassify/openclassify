<?php namespace Visiosoft\AdvsModule\OptionHandler;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\MultipleFieldType\MultipleFieldType;

class AdvsOptions
{
	private $advModel;

	public function __construct(AdvModel $advModel)
	{
		$this->advModel = $advModel;
	}

	public function handle(CheckboxesFieldType $fieldType)
	{
		$categories = $this->advModel->currentAds()->get();
		$options = $categories->pluck('name', 'id')->all();
		$fieldType->setOptions($options);
	}
}