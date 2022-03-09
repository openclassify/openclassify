<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\Component\Action\Command\ExecuteAction;
use Visiosoft\ConnectModule\Resource\Multiple\MultipleResourceBuilder;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PostResource
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class PostResource
{

    use DispatchesJobs;

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new PostResource instance.
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
     * @param Request         $request
     * @param ResponseFactory $response
     * @throws \Exception
     */
    public function handle(Request $request, ResponseFactory $response)
    {
        if ($this->builder instanceof MultipleResourceBuilder) {
            return;
        }

        $this->dispatch(new ExecuteAction($this->builder));

        if (!$this->builder->getResourceResponse()) {
            $this->builder->setResourceResponse($response->redirectTo($request->fullUrl()));
        }
    }
}
