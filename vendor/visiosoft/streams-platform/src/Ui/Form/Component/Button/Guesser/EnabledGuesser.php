<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Http\Request;

/**
 * Class EnabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EnabledGuesser
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new EnabledGuesser instance.
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

            if (!isset($button['enabled'])) {
                continue;
            }

            if (is_bool($button['enabled'])) {
                continue;
            }

            $button['enabled'] = ($mode === $button['enabled']);
        }

        $builder->setButtons($buttons);
    }
}
