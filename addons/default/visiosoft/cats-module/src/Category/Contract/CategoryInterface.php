<?php namespace Visiosoft\CatsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface CategoryInterface extends EntryInterface
{
    public function getMetaKeywords();

    public function getMetaDescription();

    public function getParent();

    public function getMains($id);
}
