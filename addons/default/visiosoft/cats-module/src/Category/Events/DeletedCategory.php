<?php namespace Visiosoft\CatsModule\Category\Events;

class DeletedCategory
{

    public $category;

    public $parents;

    public function __construct($category, $parents)
    {
        $this->category = $category;
        $this->parents = $parents;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getParents()
    {
        $this->getParents();
    }
}
