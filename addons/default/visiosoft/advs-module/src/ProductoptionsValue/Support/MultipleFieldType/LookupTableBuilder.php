<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Support\MultipleFieldType;

use Anomaly\Streams\Platform\Ui\Table\Table;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class LookupTableBuilder extends \Visiosoft\MultipleFieldType\Table\LookupTableBuilder
{
	public function __construct(Table $table,ValueTableBuilder $valueTableBuilder)
	{
		$this->valueTableBuilder = $valueTableBuilder;
		parent::__construct($table);
	}

	public function setTableEntries(\Illuminate\Support\Collection $entries)
	{
		$option_repository = app(ProductoptionRepositoryInterface::class);
		$value_repository = app(ProductoptionsValueRepositoryInterface::class);

		$options_id = $option_repository->getWithCategoryId($this->config('cat1'))->pluck('id')->all();

		$values = $value_repository->getWithOptionsId($options_id);
		return parent::setTableEntries($values);
	}

	protected $filters = [
		'product_option'
	];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
	    'name', 'product_option'
    ];
}
