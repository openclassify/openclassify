<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;

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
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * Create a new HrefGuesser instance.
     *
     * @param UrlGenerator     $url
     * @param Request          $request
     * @param ModuleCollection $modules
     */
    public function __construct(UrlGenerator $url, Request $request, ModuleCollection $modules)
    {
        $this->url     = $url;
        $this->request = $request;
        $this->modules = $modules;
    }

    /**
     * Guess the HREF for a button.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $buttons  = $builder->getButtons();
        $sections = $builder->getControlPanelSections();

        $active = $sections->active();
        $module = $this->modules->active();

        foreach ($buttons as &$button) {

            // If we already have an HREF then skip it.
            if (isset($button['attributes']['href'])) {
                continue;
            }

            // Determine the HREF based on the button type.
            switch (array_get($button, 'button')) {

                case 'add':
                case 'new':
                case 'create':
                    $button['attributes']['href'] = $active->getHref('create');
                    break;

                case 'export':
                    if ($module) {
                        $button['attributes']['href'] = $this->url->to(
                            'entry/handle/export/' . $module->getNamespace() . '/' . array_get(
                                $button,
                                'namespace'
                            ) . '/' . array_get($button, 'stream')
                        );
                    }
                    break;
            }

            $type = array_get($button, 'segment', array_get($button, 'button'));

            if (!isset($button['attributes']['href']) && $type) {
                $button['attributes']['href'] = $active->getHref($type);
            }
        }

        $builder->setButtons($buttons);
    }
}
