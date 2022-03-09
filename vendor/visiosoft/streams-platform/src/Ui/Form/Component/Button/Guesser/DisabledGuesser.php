<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class DisabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DisabledGuesser
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new DisabledGuesser instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Guess the HREF for a button.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $buttons = $builder->getButtons();
        $mode    = $builder->getFormMode();

        foreach ($buttons as &$button) {

            if (!isset($button['disabled'])) {
                continue;
            }

            if (is_bool($button['disabled'])) {
                continue;
            }

            $button['disabled'] = ($mode === $button['disabled']);
        }

        $builder->setButtons($buttons);
    }
}
