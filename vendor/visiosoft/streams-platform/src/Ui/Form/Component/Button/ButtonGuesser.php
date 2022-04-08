<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button;

use Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser\DisabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser\HrefGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser\TextGuesser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

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
     * The enabled guesser.
     *
     * @var EnabledGuesser
     */
    protected $enabled;

    /**
     * The disabled guesser.
     *
     * @var DisabledGuesser
     */
    protected $disabled;

    /**
     * Create a new ButtonGuesser instance.
     *
     * @param HrefGuesser     $href
     * @param EnabledGuesser  $enabled
     * @param DisabledGuesser $disabled
     */
    public function __construct(
        HrefGuesser $href,
        TextGuesser $text,
        EnabledGuesser $enabled,
        DisabledGuesser $disabled
    ) {
        $this->href     = $href;
        $this->text     = $text;
        $this->enabled  = $enabled;
        $this->disabled = $disabled;
    }

    /**
     * Guess button properties.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $this->href->guess($builder);
        $this->text->guess($builder);
        $this->enabled->guess($builder);
        $this->disabled->guess($builder);
    }
}
