<?php namespace Visiosoft\ProfileModule\Education;

use Visiosoft\ProfileModule\Education\Contract\EducationRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class EducationRepository extends EntryRepository implements EducationRepositoryInterface
{
    protected $model;

    public function __construct(EducationModel $model)
    {
        $this->model = $model;
    }
}
