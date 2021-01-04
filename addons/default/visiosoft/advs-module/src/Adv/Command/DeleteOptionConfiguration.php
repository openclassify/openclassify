<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;

class DeleteOptionConfiguration
{
    protected $ad;

    public function __construct(AdvInterface $ad)
    {
        $this->ad = $ad;
    }

    public function handle(OptionConfigurationRepositoryInterface $optionConfigurationRepository)
    {
        $optionConfigurationRepository->deleteAdsConfigs($this->ad->id);
    }
}
