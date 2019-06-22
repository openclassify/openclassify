<?php namespace Visiosoft\LocationModule\Village;

use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class VillageRepository extends EntryRepository implements VillageRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var VillageModel
     */
    protected $model;

    /**
     * Create a new VillageRepository instance.
     *
     * @param VillageModel $model
     */
    public function __construct(VillageModel $model)
    {
        $this->model = $model;
    }
}
