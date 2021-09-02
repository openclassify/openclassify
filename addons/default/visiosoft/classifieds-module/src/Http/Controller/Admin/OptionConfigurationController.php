<?php namespace Visiosoft\ClassifiedsModule\Http\Controller\Admin;

use Visiosoft\ClassifiedsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Table\OptionConfigurationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class OptionConfigurationController extends AdminController
{
    public function index(
        OptionConfigurationTableBuilder $table,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository
    )
	{
	    // Remove deleted classified's configuration
        $unusedConfigs = $optionConfigurationRepository->getUnusedConfigs();

        if (count($unusedConfigs)) {
            $optionConfigurationRepository->deleteUnusedConfigs($unusedConfigs);
        }

		return $table->render();
	}

	public function create(OptionConfigurationFormBuilder $form)
	{
		$form->setOption('redirect', route('visiosoft.module.classifieds::configrations.index'));
		return $form->render();
	}
}
