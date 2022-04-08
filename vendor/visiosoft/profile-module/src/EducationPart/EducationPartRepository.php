<?php namespace Visiosoft\ProfileModule\EducationPart;

use Visiosoft\ProfileModule\EducationPart\Contract\EducationPartRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class EducationPartRepository extends EntryRepository implements EducationPartRepositoryInterface
{
    protected $model;

    public function __construct(EducationPartModel $model)
    {
        $this->model = $model;
    }
}
