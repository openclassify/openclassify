<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser\TextGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser\TypeGuesser;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

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
     * The text guesser.
     *
     * @var TextGuesser
     */
    protected $text;

    /**
     * The type guesser.
     *
     * @var TypeGuesser
     */
    protected $type;

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
     * @param TextGuesser    $text
     * @param TypeGuesser    $type
     * @param EnabledGuesser $enabled
     */
    public function __construct(HrefGuesser $href, TextGuesser $text, TypeGuesser $type, EnabledGuesser $enabled)
    {
        $this->href    = $href;
        $this->text    = $text;
        $this->type    = $type;
        $this->enabled = $enabled;
    }

    /**
     * Guess button properties.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $this->type->guess($builder);
        $this->href->guess($builder);
        $this->text->guess($builder);
        $this->enabled->guess($builder);
    }
}
