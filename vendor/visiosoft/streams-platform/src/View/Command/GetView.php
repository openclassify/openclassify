<?php namespace Anomaly\Streams\Platform\View\Command;

use Illuminate\Contracts\View\Factory;

/**
 * Class GetView
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetView
{

    /**
     * The view name.
     *
     * @var string
     */
    protected $view;

    /**
     * The view data.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new GetView instance.
     *
     * @param array  $data
     * @param string $view
     */
    public function __construct($view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    /**
     * Handle the command.
     *
     * @param  Factory $view
     * @return string
     */
    public function handle(Factory $view)
    {
        return $view->make($this->view, $this->data);
    }
}
