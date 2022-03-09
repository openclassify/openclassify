<?php namespace Anomaly\RedirectsModule\Domain;

use Anomaly\RedirectsModule\Domain\Contract\DomainRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class DomainRepository extends EntryRepository implements DomainRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var DomainModel
     */
    protected $model;

    /**
     * Create a new DomainRepository instance.
     *
     * @param DomainModel $model
     */
    public function __construct(DomainModel $model)
    {
        $this->model = $model;
    }
}
