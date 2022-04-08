<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser\HandlerGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser\QueryGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Guesser\TextGuesser;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ViewGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewGuesser
{

    /**
     * The HREF guesser.
     *
     * @var HrefGuesser
     */
    protected $href;

    /**
     * The text guesser.
     *
     * @var TextGuesser
     */
    protected $text;

    /**
     * The query guesser.
     *
     * @var QueryGuesser
     */
    protected $query;

    /**
     * The query guesser.
     *
     * @var HandlerGuesser
     */
    protected $handler;

    /**
     * Create a new ViewGuesser instance.
     *
     * @param HrefGuesser    $href
     * @param TextGuesser    $text
     * @param QueryGuesser   $query
     * @param HandlerGuesser $handler
     */
    public function __construct(HrefGuesser $href, TextGuesser $text, QueryGuesser $query, HandlerGuesser $handler)
    {
        $this->href    = $href;
        $this->text    = $text;
        $this->query   = $query;
        $this->handler = $handler;
    }

    /**
     * Guess some view parameters.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $this->href->guess($builder);
        $this->text->guess($builder);
        $this->query->guess($builder);
        $this->handler->guess($builder);
    }
}
