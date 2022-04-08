<?php namespace Anomaly\Streams\Platform\Version\Table;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class VersionTableButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionTableButtons
{

    /**
     * Handle the command.
     *
     * @param VersionTableBuilder $builder
     * @param ControlPanelBuilder $controlPanel
     */
    public function handle(VersionTableBuilder $builder, ControlPanelBuilder $controlPanel)
    {
        $section = $controlPanel->getControlPanelActiveSection();

        $builder->setButtons(
            [
                'load' => [
                    'href' => $section->getHref(
                        'edit/{entry.versionable_id}?version={entry.version}&versionable={entry.versionable_type}'
                    ),
                ],
            ]
        );
    }
}
