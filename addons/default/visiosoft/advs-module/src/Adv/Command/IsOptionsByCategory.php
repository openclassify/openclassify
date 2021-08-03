<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;

class IsOptionsByCategory
{

    protected $cat_id;

    public function __construct($cat_id)
    {
        $this->cat_id = $cat_id;
    }

    public function handle()
    {
        $option_repository = app(ProductoptionRepositoryInterface::class);
        $value_repository = app(ProductoptionsValueRepositoryInterface::class);

        $options_id = $option_repository->getWithCategoryId($this->cat_id)->pluck('id')->all();

        return $value_repository->getWithOptionsId($options_id);
    }
}
