<?php namespace Visiosoft\AdvsModule\Option;

use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class OptionRepository extends EntryRepository implements OptionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var OptionModel
     */
    protected $model;

    /**
     * Create a new OptionRepository instance.
     *
     * @param OptionModel $model
     */
    public function __construct(OptionModel $model)
    {
        $this->model = $model;
    }
}
