<?php namespace Visiosoft\AdvsModule\Productoption;

use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ProductoptionRepository extends EntryRepository implements ProductoptionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ProductoptionModel
     */
    protected $model;

    /**
     * Create a new ProductoptionRepository instance.
     *
     * @param ProductoptionModel $model
     */
    public function __construct(ProductoptionModel $model)
    {
        $this->model = $model;
    }

    public function getWithCategoryId($id)
    {
    	return $this->findAllBy('category',$id);
    }
}
