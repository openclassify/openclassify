<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\AdvsModule\OptionConfiguration\Table\OptionConfigurationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class OptionConfigurationController extends AdminController
{
    public function index(
        OptionConfigurationTableBuilder $table,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository
    )
	{
	    // Remove deleted ad's configuration
        $unusedConfigs = $optionConfigurationRepository->getUnusedConfigs();

        if (count($unusedConfigs)) {
            $optionConfigurationRepository->deleteUnusedConfigs($unusedConfigs);
        }

		return $table->render();
	}

	public function create(OptionConfigurationFormBuilder $form)
	{
		$form->setOption('redirect', route('visiosoft.module.advs::configrations.index'));
		return $form->render();
	}
}
