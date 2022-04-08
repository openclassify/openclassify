<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Routing\UrlGenerator;

/**
 * Class HrefGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HrefGuesser
{

    /**
     * The URL generator.
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new HrefGuesser instance.
     *
     * @param ModuleCollection $modules
     * @param UrlGenerator     $url
     */
    public function __construct(ModuleCollection $modules, UrlGenerator $url)
    {
        $this->url     = $url;
        $this->modules = $modules;
    }

    /**
     * Guess the sections HREF attribute.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        if (!$module = $this->modules->active()) {
            return;
        }

        $sections = $builder->getSections();

        foreach ($sections as $index => &$section) {

            // If HREF is set then skip it.
            if (isset($section['attributes']['href'])) {
                continue;
            }

            $href = $this->url->to('admin/' . $module->getSlug());

            if ($index !== 0 && $module->getSlug() !== $section['slug']) {
                $href .= '/' . $section['slug'];
            }

            $section['attributes']['href'] = $href;
        }

        $builder->setSections($sections);
    }
}
