<?php namespace Visiosoft\CustomfieldsModule\Parent\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface ParentRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getByCustomFieldID($id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteByCF($id);

    public function findAllByCatID($catID);

    public function createNew($cf_id, $category_id);
}
