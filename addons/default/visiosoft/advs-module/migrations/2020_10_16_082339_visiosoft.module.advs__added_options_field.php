<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddedOptionsField extends Migration
{

	/**
	 * Don't delete stream on rollback
	 * because this isn't creating the
	 * stream only referencing it.
	 */
	protected $delete = false;

	/**
	 * Any additional information will
	 * be updated. Slug helps find
	 * the stream to work with for
	 * assignments that follow.
	 */
	protected $stream = [
		'slug' => 'advs',
	];

	/**
	 * The addon fields.
	 *
	 * @var array
	 */
	protected $fields = [
		'product_options_value' => [
			'type'   => 'anomaly.field_type.multiple',
			'config' => [
				'mode'    => 'lookup',
				'related' => \Visiosoft\AdvsModule\ProductoptionsValue\ProductoptionsValueModel::class,
			],
		]
	];

	/**
	 * The field's assignment.
	 *
	 * @var array
	 */
	protected $assignments = [
		'product_options_value',
	];
}
