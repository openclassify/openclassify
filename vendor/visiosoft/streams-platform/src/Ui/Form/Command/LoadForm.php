<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Contracts\Container\Container;

/**
 * Class LoadForm
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadForm
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new HandleForm instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
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
        $form = $this->builder->getForm();

        if ($handler = $form->getOption('data')) {
            $container->call($handler, compact('form'));
        }

        if ($layout = $form->getOption('layout_view')) {
            $template->put('layout', $layout);
        }

        if ($title = $form->getOption('title')) {
            $template->put('title', $title);
        }

        // Move this to options so we can read it.
        $this->builder->setFormOption('read_only', $this->builder->isReadOnly());

        $form->addData('form', $form);

        if ($breadcrumb = $form->getOption('breadcrumb', 'streams::form.mode.' . $this->builder->getFormMode())) {
            $breadcrumbs->put($breadcrumb, '#');
        }
    }
}
