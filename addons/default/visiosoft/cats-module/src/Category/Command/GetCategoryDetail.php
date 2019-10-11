<?php namespace Visiosoft\CatsModule\Category\Command;

use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;

class GetCategoryDetail
{

    /**
     * @var $id
     */
    protected $id;

    /**
     * GetProduct constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * @param CategoryRepositoryInterface $groups
     * @return |null
     */
    public function handle(CategoryRepositoryInterface $groups)
    {
        if ($this->id) {
            $category = $groups->find($this->id);
            if (!is_null($category))
                return $category;
            else
                return null;
        }
        return null;
    }
}
