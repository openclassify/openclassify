<?php namespace Visiosoft\AdvsModule\OptionHandler;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class AdvsOptions
{
	private $advRepository;

	public function __construct(AdvRepositoryInterface $advRepository)
	{
		$this->advRepository = $advRepository;
	}

	public function handle(CheckboxesFieldType $fieldType)
	{
		$categories = $this->advRepository->all();
		$options = $categories->pluck('name', 'id')->all();
		$fieldType->setOptions($options);
	}
}