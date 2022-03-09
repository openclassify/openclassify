<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Container\Container;

/**
 * Class LoadEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class LoadEntity
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new HandleEntity instance.
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
     * @param Container            $container
     * @param ViewTemplate         $template
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Container $container, ViewTemplate $template, BreadcrumbCollection $breadcrumbs)
    {
        $entity = $this->builder->getEntity();

        if ($handler = $entity->getOption('data')) {
            $container->call($handler, compact('entity'));
        }

        if ($layout = $entity->getOption('layout_view')) {
            $template->put('layout', $layout);
        }

        if ($title = $entity->getOption('title')) {
            $template->put('title', $title);
        }

        $entity->addData('entity', $entity);

        if ($breadcrumb = $entity->getOption('breadcrumb', 'streams::entity.mode.' . $entity->getMode())) {
            $breadcrumbs->put($breadcrumb, '#');
        }
    }
}
