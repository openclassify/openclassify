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

    public function getMainCats() {
        $mainCats = $this->categoryRepository->newQuery()
            ->whereNull('parent_category_id')
            ->orderBy('sort_order')
            ->get();

        foreach ($mainCats as $cat) {
            $subCount = $this->categoryRepository->newQuery()->where('parent_category_id', $cat->id)->count();
            $cat->hasChild = !!$subCount;
        }

        return $mainCats;
    }
}
