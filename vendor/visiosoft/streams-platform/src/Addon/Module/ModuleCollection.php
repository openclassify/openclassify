<?php namespace Anomaly\Streams\Platform\Addon\Module;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class ModuleCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ModuleCollection extends AddonCollection
{

    /**
     * Return navigate-able modules.
     *
     * @return ModuleCollection
     */
    public function navigation()
    {
        $navigation = [];

        /* @var Module $item */
        foreach ($this->items as $item) {
            if ($item->getNavigation()) {
                $navigation[trans($item->getName())] = $item;
            }
        }

        ksort($navigation);

        foreach ($navigation as $key => $item) {
            if ($item->getNamespace() == 'anomaly.module.dashboard') {
                $navigation = [$key => $item] + $navigation;

                break;
            }
        }

        return self::make($navigation)
            ->enabled()
            ->accessible();
    }

    /**
     * Return accessible modules.
     *
     * @return ModuleCollection
     */
    public function accessible()
    {
        $accessible = [];

        /* @var Authorizer $authorizer */
        $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');

        /* @var Module $item */
        foreach ($this->items as $item) {
            if ($authorizer->authorize($item->getNamespace('*'))) {
                $accessible[] = $item;
            }
        }

        return self::make($accessible);
    }

    /**
     * Return enabled modules.
     *
     * @return ModuleCollection
     */
    public function enabled()
    {
        $enabled = [];

        /* @var Module $item */
        foreach ($this->items as $item) {
            if ($item->isEnabled()) {
                $enabled[] = $item;
            }
        }

        return self::make($enabled);
    }

    /**
     * Return disabled modules.
     *
     * @return ModuleCollection
     */
    public function disabled()
    {
        $disabled = [];

        /* @var Module $item */
        foreach ($this->items as $item) {
            if (!$item->isEnabled()) {
                $disabled[] = $item;
            }
        }

        return self::make($disabled);
    }

    /**
     * Return the active module.
     *
     * @return Module
     */
    public function active()
    {
        /* @var Module $item */
        foreach ($this->items as $item) {
            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return installed modules.
     *
     * @return ModuleCollection
     */
    public function installed()
    {
        $installed = [];

        /* @var Module $item */
        foreach ($this->items as $item) {
            if ($item->isInstalled()) {
                $installed[] = $item;
            }
        }

        return self::make($installed);
    }

    /**
     * Return uninstalled modules.
     *
     * @return ModuleCollection
     */
    public function uninstalled()
    {
        $installed = [];

        /* @var Module $item */
        foreach ($this->items as $item) {
            if (!$item->isInstalled()) {
                $installed[] = $item;
            }
        }

        return self::make($installed);
    }

    /**
     * Set the installed and enabled states.
     *
     * @param array $installed
     */
    public function setStates(array $states)
    {
        foreach ($states as $state) {
            if ($module = $this->get($state->namespace)) {
                $this->setFlags($module, $state);
            }
        }
    }

    /**
     * Set the module flags from a state object.
     *
     * @param Module $module
     * @param        $state
     */
    protected function setFlags(Module $module, $state)
    {
        $module->setEnabled($state->enabled);
        $module->setInstalled($state->installed);
    }
}
