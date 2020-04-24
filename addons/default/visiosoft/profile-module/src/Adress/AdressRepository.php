<?php namespace Visiosoft\ProfileModule\Adress;

use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class AdressRepository extends EntryRepository implements AdressRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var AdressModel
     */
    protected $model;

    /**
     * Create a new AdressRepository instance.
     *
     * @param AdressModel $model
     */
    public function __construct(AdressModel $model)
    {
        $this->model = $model;
    }

    public function findByUser($user_id)
    {
        return $this->newQuery()->where('user_id', $user_id)->get();
    }
}
