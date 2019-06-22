<?php namespace Visiosoft\CatsModule\Placeholderforsearch;

use Visiosoft\CatsModule\Placeholderforsearch\Contract\PlaceholderforsearchRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class PlaceholderforsearchRepository extends EntryRepository implements PlaceholderforsearchRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var PlaceholderforsearchModel
     */
    protected $model;

    /**
     * Create a new PlaceholderforsearchRepository instance.
     *
     * @param PlaceholderforsearchModel $model
     */
    public function __construct(PlaceholderforsearchModel $model)
    {
        $this->model = $model;
    }
}
