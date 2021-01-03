<?php namespace Visiosoft\ProfileModule\EducationPart;

use Visiosoft\ProfileModule\EducationPart\Contract\EducationPartRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class EducationPartRepository extends EntryRepository implements EducationPartRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var EducationPartModel
     */
    protected $model;

    /**
     * Create a new EducationPartRepository instance.
     *
     * @param EducationPartModel $model
     */
    public function __construct(EducationPartModel $model)
    {
        $this->model = $model;
    }
}
