<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\AdvsModule\OptionConfiguration\Table\OptionConfigurationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class OptionConfigurationController extends AdminController
{

	/**
	 * Display an index of existing entries.
	 *
	 * @param OptionConfigurationTableBuilder $table
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(OptionConfigurationTableBuilder $table)
	{
		return $table->render();
	}

	/**
	 * Create a new entry.
	 *
	 * @param OptionConfigurationFormBuilder $form
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function create(OptionConfigurationFormBuilder $form)
	{
		$form->setOption('redirect', route('visiosoft.module.advs::configrations.index'));
		return $form->render();
	}
}
