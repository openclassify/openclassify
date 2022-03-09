<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class SetDefaultOptions
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetDefaultOptions
{

    /**
     * The table builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
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
     * @param ModuleCollection $modules
     * @param ThemeCollection  $themes
     * @param Request          $request
     */
    public function handle(ModuleCollection $modules, ThemeCollection $themes, Request $request)
    {
        $theme = $themes->current();

        /*
         * Default the form view based on the request.
         */
        if (!$this->builder->getFormOption('form_view') && $this->builder->isAjax()) {
            $this->builder->setFormOption('form_view', 'streams::form/ajax');
        }

        if (!$this->builder->getFormOption('form_view') && $theme && $theme->isAdmin()) {
            $this->builder->setFormOption('form_view', 'streams::form/form');
        }

        if (!$this->builder->getFormOption('form_view') && $theme && !$theme->isAdmin()) {
            $this->builder->setFormOption('form_view', 'streams::form/standard');
        }

        if (!$this->builder->getFormOption('form_view')) {
            $this->builder->setFormOption('form_view', 'streams::form/form');
        }

        /*
         * Default the form wrapper view as well.
         */
        if (!$this->builder->getFormOption('wrapper_view') && $this->builder->isAjax()) {
            $this->builder->setFormOption('wrapper_view', 'streams::ajax');
        }

        if (!$this->builder->getFormOption('wrapper_view')) {
            $this->builder->setFormOption('wrapper_view', 'streams::blank');
        }

        /*
         * If the permission is not set then
         * try and automate it.
         */
        if (
            $this->builder->getFormOption('permission') === null &&
            $request->segment(1) == 'admin' &&
            ($module = $modules->active()) &&
            ($stream = $this->builder->getFormStream())
        ) {
            $this->builder->setFormOption(
                'permission',
                $module->getNamespace($stream->getSlug() . '.write')
            );
        }
    }
}
