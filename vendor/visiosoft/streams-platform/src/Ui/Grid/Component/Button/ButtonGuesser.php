<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Button;

use Anomaly\Streams\Platform\Ui\Grid\Component\Button\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

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
     * @param GridBuilder $builder
     */
    public function guess(GridBuilder $builder)
    {
        $this->href->guess($builder);
    }
}
