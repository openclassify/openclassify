<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class MakeEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class MakeEntity
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new MakeEntity instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $entity = $this->builder->getEntity();

        $options = $entity->getOptions();
        $data    = $entity->getData();

        $content = view(
            $options->get('entity_view', $this->builder->isAjax() ? 'streams::entity/ajax' : 'streams::entity/entity'),
            $data->all()
        );

        $entity->setContent($content);
        $entity->addData('content', $content);
    }
}
