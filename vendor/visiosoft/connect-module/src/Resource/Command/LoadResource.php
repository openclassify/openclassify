<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class LoadResource
 *

 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class LoadResource
{

    use DispatchesJobs;

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new LoadResource instance.
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
     * @param Container            $container
     * @param ViewTemplate         $template
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Container $container)
    {
        $resource = $this->builder->getResource();

        if ($handler = $this->builder->getResourceOption('data')) {

            // Self handling implies @handle
            if (is_string($handler) && !str_contains($handler, '@')) {
                $handler .= '@handle';
            }

            $container->call($handler, compact('resource'));
        }
    }
}
