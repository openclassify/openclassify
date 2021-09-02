<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;

class DeleteOptionConfiguration
{
    protected $classified;

    public function __construct(ClassifiedInterface $classified)
    {
        $this->classified = $classified;
    }

    public function handle(OptionConfigurationRepositoryInterface $optionConfigurationRepository)
    {
        $optionConfigurationRepository->deleteClassifiedsConfigs($this->classified->id);
    }
}
