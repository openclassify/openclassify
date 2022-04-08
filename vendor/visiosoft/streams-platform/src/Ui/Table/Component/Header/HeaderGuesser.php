<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Ui\Table\Component\Header\Guesser\HeadingsGuesser;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Guesser\SortableGuesser;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeaderGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HeaderGuesser
{

    /**
     * The headings guesser.
     *
     * @var HeadingsGuesser
     */
    protected $headings;

    /**
     * The sortable guesser.
     *
     * @var SortableGuesser
     */
    protected $sortable;

    /**
     * Create a new HeaderGuesser instance.
     *
     * @param HeadingsGuesser $headings
     * @param SortableGuesser $sortable
     */
    public function __construct(HeadingsGuesser $headings, SortableGuesser $sortable)
    {
        $this->headings = $headings;
        $this->sortable = $sortable;
    }

    /**
     * Guess header properties.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $this->headings->guess($builder);
        $this->sortable->guess($builder);
    }
}
