<?php

namespace Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;

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
     * The sections collection.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new HrefGuesser instance.
     *
     * @param UrlGenerator $url
     * @param Request $request
     * @param SectionCollection $sections
     */
    public function __construct(UrlGenerator $url, Request $request, SectionCollection $sections)
    {
        $this->url      = $url;
        $this->request  = $request;
        $this->sections = $sections;
    }

    /**
     * Guess the HREF for a button.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $buttons = $builder->getButtons();
        $entry   = $builder->getFormEntry();

        // Nothing to do if empty.
        if (!$section = $this->sections->active()) {
            return;
        }

        foreach ($buttons as &$button) {

            // Skip if already defined.
            if (isset($button['attributes']['href'])) {
                continue;
            }

            /**
             * If a route has been defined then
             * move that to an HREF closure.
             */
            if (($route = array_pull($button, 'route')) && $builder->getFormStream()) {

                $button['attributes']['href'] = $entry->route($route);

                continue;
            }

            switch (Arr::get($button, 'button')) {

                case 'cancel':
                    $button['attributes']['href'] = $section->getHref();
                    break;

                case 'delete':
                    $button['attributes']['href'] = $section->getHref('delete/' . $entry->getId());
                    break;

                default:

                    // Determine the HREF based on the button type.
                    $type = Arr::get($button, 'segment', Arr::get($button, 'button'));

                    if ($type && !Str::contains($type, '\\') && !class_exists($type)) {
                        if ($builder instanceof MultipleFormBuilder) {
                            $button['attributes']['href'] = $section->getHref($type . '/{request.route.parameters.id}');
                        } else {
                            $button['attributes']['href'] = $section->getHref($type . '/{entry.id}');
                        }
                    }
                    break;
            }
        }

        $builder->setButtons($buttons);
    }
}
