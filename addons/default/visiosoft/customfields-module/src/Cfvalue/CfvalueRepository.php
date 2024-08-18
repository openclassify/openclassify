<?php namespace Visiosoft\CustomfieldsModule\Cfvalue;

use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CfvalueRepository extends EntryRepository implements CfvalueRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CfvalueModel
     */
    protected $model;

    /**
     * Create a new CfvalueRepository instance.
     *
     * @param CfvalueModel $model
     */
    public function __construct(CfvalueModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteByCF($id)
    {
        return $this->model->where('custom_field_id', $id)->delete();
    }
}
