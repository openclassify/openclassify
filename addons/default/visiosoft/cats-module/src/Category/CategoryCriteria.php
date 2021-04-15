<?php namespace Visiosoft\CatsModule\Category;

use Anomaly\Streams\Platform\Entry\EntryCriteria;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Builder;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class CategoryCriteria extends EntryCriteria
{

    private $categoryRepository;

    public function __construct(
        Builder $query, StreamInterface $stream, $method,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        parent::__construct($query, $stream, $method);
        $this->categoryRepository = $categoryRepository;
    }

    public function getMainCategories() {
        return $this->categoryRepository->getMainCategories();
    }
}
