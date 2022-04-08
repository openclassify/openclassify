<?php namespace Visiosoft\ProfileModule\OptionHandler;

use Anomaly\SelectFieldType\SelectFieldType;
use Visiosoft\ProfileModule\Education\Contract\EducationRepositoryInterface;

class EducationOptions
{
	private $educationRepository;

	public function __construct(EducationRepositoryInterface $repository)
	{
		$this->educationRepository = $repository;
	}

	public function handle(SelectFieldType $fieldType)
	{
		$educations = $this->educationRepository->all();
		$options = $educations->pluck('name', 'id')->all();
		$fieldType->setOptions($options);
	}
}