<?php namespace Anomaly\Streams\Platform\Ui\Button;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Support\Translator;
use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;

/**
 * Class ButtonFactory
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ButtonFactory
{

    /**
     * The default button class.
     *
     * @var string
     */
    protected $button = Button::class;

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * The translator utility.
     *
     * @var Translator
     */
    protected $translator;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new ButtonFactory instance.
     *
     * @param ButtonRegistry $buttons
     * @param Authorizer     $authorizer
     * @param Translator     $translator
     * @param Hydrator       $hydrator
     */
    public function __construct(
        ButtonRegistry $buttons,
        Authorizer $authorizer,
        Translator $translator,
        Hydrator $hydrator
    ) {
        $this->buttons    = $buttons;
        $this->hydrator   = $hydrator;
        $this->authorizer = $authorizer;
        $this->translator = $translator;
    }

    /**
     * Make a button.
     *
     * @param  array           $parameters
     * @return ButtonInterface
     */
    public function make(array $parameters)
    {
        $button = array_get($parameters, 'button');

        if ($button && $registered = $this->buttons->get($button)) {
            $parameters = array_replace_recursive($registered, array_except($parameters, 'button'));
        }

        $parameters = $this->translator->translate($parameters);

        if (!array_get($parameters, 'button') || !class_exists(array_get($parameters, 'button'))) {
            array_set($parameters, 'button', $this->button);
        }

        /* @var ButtonInterface $button */
        $button = app()->make(array_get($parameters, 'button'), $parameters);

        $this->hydrator->hydrate($button, $parameters);

        if (($permission = $button->getPermission()) && !$this->authorizer->authorize($permission)) {
            $button->setEnabled(false);
        }

        return $button;
    }
}
