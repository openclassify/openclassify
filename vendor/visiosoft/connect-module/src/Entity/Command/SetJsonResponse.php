<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Routing\ResponseFactory;

/**
 * Class SetJsonResponse
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetJsonResponse
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetJsonResponse instance.
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
        $this->builder->setEntityResponse(
            $response->json(
                [
                    'errors'   => $this->builder->getEntityErrors()->getMessages(),
                    'redirect' => $this->builder->getEntityActions()->active()->getRedirect(),
                ]
            )
        );
    }
}
