<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Button\Guesser;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
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
     * Guess the enabled property.
     *
     * @param ControlPanelBuilder $builder
     */
    public function guess(ControlPanelBuilder $builder)
    {
        $buttons = $builder->getButtons();

        foreach ($buttons as &$button) {
            
            if (!isset($button['enabled']) || is_bool($button['enabled'])) {
                continue;
            }
            
            /**
             * This is handy for looking at query string input
             * and toggling buttons on and off if there is a value.
             */
            if (is_string($button['enabled']) && is_numeric($button['enabled'])) {
                $button['enabled'] = true;
            }

            /**
             * This is handy for looking at the URI path
             * and toggling buttons on and off if matching.
             */
            if (is_string($button['enabled'])) {
                $button['enabled'] = str_is($button['enabled'], $this->request->path());
            }
        }

        $builder->setButtons($buttons);
    }
}
