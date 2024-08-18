<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface CfvalueRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function deleteByCF($id);
}
