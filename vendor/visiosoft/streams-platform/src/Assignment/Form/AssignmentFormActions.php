<?php namespace Anomaly\Streams\Platform\Assignment\Form;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class AssignmentFormActions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentFormActions
{

    /**
     * Handle the actions.
     *
     * @param AssignmentFormBuilder $builder
     * @param ControlPanelBuilder $cp
     */
    public function handle(AssignmentFormBuilder $builder, ControlPanelBuilder $cp)
    {
        $choose = $cp->getActiveControlPanelSectionHref('choose');

        $builder->setActions(
            [
                'save'        => [
                    'enabled'  => 'create',
                    'redirect' => $cp->getActiveControlPanelSectionHref(),
                ],
                'save_create' => [
                    'enabled'  => 'create',
                    'redirect' => $cp->getActiveControlPanelSectionHref('#click:[href="' . $choose . '"]'),
                ],
                'update'      => [
                    'enabled' => 'edit',
                ],
                'save_exit'   => [
                    'enabled' => 'edit',
                ],
            ]
        );
    }
}
