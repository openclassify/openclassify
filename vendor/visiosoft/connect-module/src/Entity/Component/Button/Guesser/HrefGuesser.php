<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

/**
 * Class HrefGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser
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
     * @param UrlGenerator      $url
     * @param Request           $request
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
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $buttons = $builder->getButtons();
        $entry   = $builder->getEntityEntry();

        // Nothing to do if empty.
        if (!$section = $this->sections->active()) {
            return;
        }

        foreach ($buttons as &$button) {

            if (isset($button['attributes']['href'])) {
                continue;
            }

            switch (array_get($button, 'button')) {

                case 'cancel':
                    $button['attributes']['href'] = $section->getHref();
                    break;

                case 'delete':
                    $button['attributes']['href'] = $section->getHref('delete/' . $entry->getId());
                    break;
            }
        }

        $builder->setButtons($buttons);
    }
}
