<?php namespace Visiosoft\ClassifiedsModule\Option;

use Visiosoft\ClassifiedsModule\Option\Contract\OptionRepositoryInterface;
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
