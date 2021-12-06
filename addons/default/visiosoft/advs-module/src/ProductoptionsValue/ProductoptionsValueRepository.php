<?php namespace Visiosoft\AdvsModule\ProductoptionsValue;

use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ProductoptionsValueRepository extends EntryRepository implements ProductoptionsValueRepositoryInterface
{

	/**
	 * The entry model.
	 *
	 * @var ProductoptionsValueModel
	 */
	protected $model;

	/**
	 * Create a new ProductoptionsValueRepository instance.
	 *
	 * @param ProductoptionsValueModel $model
	 */
	public function __construct(ProductoptionsValueModel $model)
	{
		$this->model = $model;
	}

    public function getWithOptionsId(array $ids)
    {
        return $this->newQuery()->whereIn('product_option_id', $ids)->get();
    }

    public function searchByOption($option, $value)
    {
        return $this->newQuery()->where('product_option_id', $option)
            ->where('name', 'like', '%' . $value . '%')
            ->get();
    }
}
