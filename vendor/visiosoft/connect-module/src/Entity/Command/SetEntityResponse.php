<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Routing\ResponseFactory;

/**
 * Class SetEntityResponse
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetEntityResponse
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetEntityResponse instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ResponseFactory $response
     */
    public function handle(ResponseFactory $response)
    {
        $options = $this->builder->getEntityOptions();
        $data    = $this->builder->getEntityData();

        $this->builder->setEntityResponse(
            $response->view(
                $options->get('wrapper_view', $this->builder->isAjax() ? 'streams::ajax' : 'streams::blank'),
                $data
            )
        );
    }
}
