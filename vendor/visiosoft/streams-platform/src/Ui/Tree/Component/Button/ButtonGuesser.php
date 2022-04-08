<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Button;

use Anomaly\Streams\Platform\Ui\Tree\Component\Button\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class ButtonGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonGuesser
{

    /**
     * The HREF guesser.
     *
     * @var HrefGuesser
     */
    protected $href;

    /**
     * Create a new ButtonGuesser instance.
     *
     * @param HrefGuesser $href
     */
    public function __construct(HrefGuesser $href)
    {
        $this->href = $href;
    }

    /**
     * Guess button properties.
     *
     * @param TreeBuilder $builder
     */
    public function guess(TreeBuilder $builder)
    {
        $this->href->guess($builder);
    }
}
