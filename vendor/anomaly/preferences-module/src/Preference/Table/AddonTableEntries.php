<?php namespace Anomaly\PreferencesModule\Preference\Table;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;

/**
 * Class AddonTableEntries
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonTableEntries
{

    /**
     * Handle the command.
     *
     * @param AddonTableBuilder $builder
     * @param AddonCollection   $addons
     */
    public function handle(AddonTableBuilder $builder, AddonCollection $addons)
    {
        /* @var AddonCollection|ModuleCollection|ExtensionCollection $entries */
        $entries = $addons->{$builder->getType()}->withAnyConfig(['preferences', 'preferences/preferences']);

        if (in_array($builder->getType(), ['modules', 'extensions'])) {
            $entries = $entries->enabled();
        }

        $builder->setTableEntries($entries);
    }
}
