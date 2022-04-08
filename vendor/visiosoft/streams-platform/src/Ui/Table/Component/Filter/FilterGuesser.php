<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Guesser\PlaceholdersGuesser;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FilterGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilterGuesser
{

    /**
     * The placeholders guesser.
     *
     * @var PlaceholdersGuesser
     */
    protected $placeholders;

    /**
     * Create a new FilterGuesser instance.
     *
     * @param PlaceholdersGuesser $placeholders
     */
    public function __construct(PlaceholdersGuesser $placeholders)
    {
        $this->placeholders = $placeholders;
    }

    /**
     * Guess some table filter properties.
     *
     * @param TableBuilder $builder
     */
    public function guess(TableBuilder $builder)
    {
        $this->placeholders->guess($builder);
    }
}
