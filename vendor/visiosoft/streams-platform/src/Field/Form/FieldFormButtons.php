<?php

namespace Anomaly\Streams\Platform\Field\Form;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Illuminate\Routing\Route;

/**
 * Class FieldFormButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldFormButtons
{

    /**
     * Handle the buttons.
     *
     * @param FieldFormBuilder $builder
     * @param ModuleCollection $modules
     * @param Route            $route
     * @param UrlGenerator     $url
     */
    public function handle(FieldFormBuilder $builder, ModuleCollection $modules, Route $route, UrlGenerator $url)
    {
        $module = $modules->active();
        $field  = $builder->getFormEntry();
        $type   = $field->getType();

        $enabled = $builder->getFormMode() == 'edit'
            && $module
            && $url->hasRoute($module->getNamespace('fields.change'));

        $builder->setButtons(
            [
                'cancel',
                'change' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'disabled'    => $builder->getFormMode() == 'edit'
                        && !$type->getColumnType(),
                    'enabled'     => $enabled,
                    'href'        => $enabled ? $url->route(
                        $module->getNamespace('fields.change'),
                        ['id' => $route->parameter('id')]
                    ) : '#',
                ],
            ]
        );
    }
}
