<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SetResourceResponse
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class SetResourceResponse
{

    use DispatchesJobs;

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new SetResourceResponse instance.
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
        switch (strtolower($this->builder->getResourceOption('format', 'json'))) {

            case 'json':
                $response = $this->dispatch(new MakeJsonResponse($this->builder));
                break;

            case 'xml':
                $response = $this->dispatch(new MakeXmlResponse($this->builder));
                break;

            case 'html':
                $response = $this->dispatch(new MakeViewResponse($this->builder));
                break;

            default:
                $response = $this->dispatch(new MakeViewResponse($this->builder));
        }

        $this->builder->setResourceResponse($response);
    }
}
