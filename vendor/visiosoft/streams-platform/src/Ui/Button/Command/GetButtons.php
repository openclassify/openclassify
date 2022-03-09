<?php namespace Anomaly\Streams\Platform\Ui\Button\Command;

use Illuminate\Contracts\View\Factory;

/**
 * Class GetButtons
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetButtons
{

    /**
     * The button collection.
     *
     * @var mixed
     */
    protected $buttons;

    /**
     * Create a new GetButtons instance.
     *
     * @param $buttons
     */
    public function __construct($buttons)
    {
        $this->buttons = $buttons;
    }

    /**
     * Handle the command.
     *
     * @param  Factory                         $view
     * @return \Illuminate\Contracts\View\View
     */
    public function handle(Factory $view)
    {
        return $view->make('streams::buttons/buttons', ['buttons' => $this->buttons]);
    }
}
