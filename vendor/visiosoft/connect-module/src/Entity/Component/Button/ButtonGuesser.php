<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Button\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button
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
     * The enabled guesser.
     *
     * @var EnabledGuesser
     */
    protected $enabled;

    /**
     * Create a new ButtonGuesser instance.
     *
     * @param HrefGuesser    $href
     * @param EnabledGuesser $enabled
     */
    public function __construct(HrefGuesser $href, EnabledGuesser $enabled)
    {
        $this->href    = $href;
        $this->enabled = $enabled;
    }

    /**
     * Guess button properties.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $this->href->guess($builder);
        $this->enabled->guess($builder);
    }
}
