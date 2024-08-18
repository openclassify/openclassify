<?php namespace Visiosoft\CustomfieldsModule\Parent;

use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ParentRepository extends EntryRepository implements ParentRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ParentModel
     */
    protected $model;

    /**
     * Create a new ParentRepository instance.
     *
     * @param ParentModel $model
     */
    public function __construct(ParentModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed|ParentModel
     */
    public function getByCustomFieldID($id)
    {
        return $this->model->where('cf_id', $id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteByCF($id)
    {
        return $this->model->where('cf_id', $id)->delete();
    }

    public function findAllByCatID($catID)
    {
        return $this->findAllBy('cat_id', $catID);
    }

    public function createNew($cf_id, $category_id)
    {
        return $this->create([
            'cf_id' => $cf_id,
            'cat_id' => $category_id
        ]);
    }
}
