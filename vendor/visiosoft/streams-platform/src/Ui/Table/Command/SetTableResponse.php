<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Routing\ResponseFactory;

/**
 * Class SetTableResponse
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetTableResponse
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new SetTableResponse instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
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
        $table = $this->builder->getTable();

        $options = $table->getOptions();
        $data    = $table->getData();

        $table->setResponse(
            $response->view(
                $options->get('wrapper_view', $this->builder->isAjax() ? 'streams::ajax' : 'streams::blank'),
                $data
            )
        );
    }
}
