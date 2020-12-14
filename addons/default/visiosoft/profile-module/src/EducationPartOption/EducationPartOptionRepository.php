<?php namespace Visiosoft\ProfileModule\EducationPartOption;

use Visiosoft\ProfileModule\EducationPartOption\Contract\EducationPartOptionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class EducationPartOptionRepository extends EntryRepository implements EducationPartOptionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var EducationPartOptionModel
     */
    protected $model;

    /**
     * Create a new EducationPartOptionRepository instance.
     *
     * @param EducationPartOptionModel $model
     */
    public function __construct(EducationPartOptionModel $model)
    {
        $this->model = $model;
    }
}
