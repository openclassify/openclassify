<?php namespace Visiosoft\LanguageSwitcherPlugin;

use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Visiosoft\LanguageSwitcherPlugin\LanguageSwitcher\Command\RenderLanguageSwitcher;

/**
 * Class LanguageSwitcherPlugin
 * @package Visiosoft\LanguageSwitcherPlugin
 */
class LanguageSwitcherPlugin extends Plugin
{

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'languageSwitcher',
                function ($type = "dropdown", $options = []) {
                    return $this->dispatch(new RenderLanguageSwitcher($type, $options));
                },
                [
                    'is_safe' => ['html']
                ]
            )
        ];
    }
}
