<?php namespace Anomaly\Streams\Platform\Ui\Entity\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Entity\Entity;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\MultipleEntityBuilder;


/**
 * Class MergeFields
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Multiple\Command
 */
class MergeFields
{

    /**
     * The multiple entity builder.
     *
     * @var MultipleEntityBuilder
     */
    protected $builder;

    /**
     * Create a new MergeFields instance.
     *
     * @param MultipleEntityBuilder $builder
     */
    public function __construct(MultipleEntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var EntityBuilder $builder */
        foreach ($this->builder->getEntities() as $builder) {
            $this->mergeFields($this->builder->getEntity(), $builder->getEntity());
        }
    }

    /**
     * Merge fields into the entity.
     *
     * @param Entity $parent
     * @param Entity $child
     */
    protected function mergeFields(Entity $parent, Entity $child)
    {
        foreach ($child->getFields() as $field) {
            $parent->addField($field);
        }
    }
}
