<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Http\Request;
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
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new HrefGuesser instance.
     *
     * @param UrlGenerator $url
     * @param Request      $request
     */
    public function __construct(UrlGenerator $url, Request $request)
    {
        $this->url     = $url;
        $this->request = $request;
    }

    /**
     * Guess the HREF for the views.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $views = $builder->getViews();

        foreach ($views as &$view) {

            // Only automate it if not set.
            if (!isset($view['attributes']['href'])) {
                $view['attributes']['href'] = $this->url->to(
                    $this->request->path() . '?' . array_get($view, 'prefix') . 'view=' . $view['slug']
                );
            }
        }

        $builder->setViews($views);
    }
}
