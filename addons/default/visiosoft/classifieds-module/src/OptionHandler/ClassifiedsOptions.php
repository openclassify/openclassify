<?php namespace Visiosoft\ClassifiedsModule\OptionHandler;

use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;

class ClassifiedsOptions
{
	private $classifiedModel;

	public function __construct(ClassifiedModel $classifiedModel)
	{
		$this->classifiedModel = $classifiedModel;
	}

	public function handle(CheckboxesFieldType $fieldType)
	{
		$categories = $this->classifiedModel->currentClassifieds()->get();
		$options = $categories->pluck('name', 'id')->all();
		$fieldType->setOptions($options);
	}
}