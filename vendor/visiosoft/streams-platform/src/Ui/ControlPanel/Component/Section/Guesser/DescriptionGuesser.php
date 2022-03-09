<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class DescriptionGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DescriptionGuesser
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new DescriptionGuesser instance.
     *
     * @param ModuleCollection $modules
     */
    public function __construct(ModuleCollection $modules)
    {
        $this->modules = $modules;
    }

    /**
     * Guess the sections description.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        if (!$module = $this->modules->active()) {
            return;
        }

        $sections = $builder->getSections();

        foreach ($sections as &$section) {

            // If description is set then skip it.
            if (isset($section['description'])) {
                continue;
            }

            $description = $module->getNamespace('section.' . $section['slug'] . '.description');

            if (trans()->has($description)) {
                $section['description'] = $description;
            }
        }

        $builder->setSections($sections);
    }
}
