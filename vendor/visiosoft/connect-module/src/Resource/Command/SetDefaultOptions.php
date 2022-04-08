<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class SetDefaultOptions
 *

 * @package Visiosoft\ConnectModule\Resource\Command
 */
class SetDefaultOptions
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $resource = $this->builder->getResource();

        /**
         * Set the default output format.
         */
        if (!$resource->getOption('format')) {
            $resource->setOption('format', 'json');
        }

        /**
         * Set the default ordering options.
         */
//        if (!$resource->getOption('order_by')) {
//
//            $model = $resource->getModel();
//
//            if ($model instanceof EntryModel) {
//                if ($model->titleColumnIsTranslatable()) {
//                    $resource->setOption('order_by', ['sort_order' => 'asc']);
//                } else {
//                    $resource->setOption('order_by', [$model->getTitleName() => 'asc']);
//                }
//            } elseif ($model instanceof EloquentModel) {
//                $resource->setOption('order_by', ['id' => 'asc']);
//            }
//        }

        /**
         * Limit to 1 result if ID is set.
         */
        if ($this->builder->getId()) {
            $resource->setOption('limit', 1);
            $resource->setOption('paginate', false);
        }

        /**
         * If the resource ordering is currently being overridden
         * then set the values from the request on the builder
         * last so it actually has an effect.
         */
        if ($orderBy = $this->builder->getRequestValue('order_by')) {
            $resource->setOption('order_by', [$orderBy => $this->builder->getRequestValue('sort', 'asc')]);
        }
    }
}
