<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\Component\Result\Result;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Visiosoft\ConnectModule\Resource\ResourcePagination;
use Anomaly\Streams\Platform\Support\Evaluator;

/**
 * Class AddEntriesData
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class AddEntriesData
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResourceFormattersCommand instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * * @param Evaluator $evaluator
     * @param ResourcePagination $pagination
     */
    public function handle(Evaluator $evaluator, ResourcePagination $pagination)
    {
        $entries = array_map(
            function (Result $result) {
                return (object)$result->toArray();
            },
            $this->builder->getResourceResults()->all()
        );


        if ($this->builder->getId() || !count($this->builder->getResourceEntries())) {
            $this->builder->addResourceData('data', array_shift($entries));
        } else {

            $this->builder->addResourceData('data', $entries);

            if (!$this->builder->getResourceOption('map') && $this->builder->getPaginate()) {
                $this->builder->addResourceData('pagination', $pagination->make($this->builder));
            }
        }
    }
}
