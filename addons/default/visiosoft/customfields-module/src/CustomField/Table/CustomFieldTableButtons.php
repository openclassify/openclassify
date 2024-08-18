<?php namespace Visiosoft\CustomfieldsModule\CustomField\Table;


use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldInterface;

class CustomFieldTableButtons
{

	/**
	 * Handle the buttons.
	 *
	 * @param CustomFieldTableBuilder $builder
	 */
	public function handle(CustomFieldTableBuilder $builder)
	{
		$builder->setButtons([
			'create_cf_value' => [
				'href' => 'admin/customfields/cfvalue/create?type={entry.id}',
				'icon' => 'fa fa-plus',
				'class' => function (CustomFieldInterface $entry) {
					return $this->is_cfvalue($entry, 'btn btn-success');
				},
			],
			'all_cf_values' => [
				'href' => 'admin/customfields/cfvalue?filter_custom_field={entry.id}',
				'icon' => 'fa fa-list',
				'class' => function (CustomFieldInterface $entry) {
					return $this->is_cfvalue($entry, 'btn btn-danger');
				},
			],
			'edit',
		]);
	}

	public function is_cfvalue($entry, $class = 'btn btn-default')
	{
		if ($entry->checkType('select')
			|| $entry->checkType('radio')
			|| $entry->checkType('checkboxes')
			|| $entry->checkType('selectdropdown')
			|| $entry->checkType('selecttop')
			|| $entry->checkType('selectrange')
			|| $entry->checkType('selectimage')
		) {
			return $class;
		} else {
			return 'hidden';
		}
	}
}
