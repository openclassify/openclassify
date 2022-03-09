<?php namespace Anomaly\Streams\Platform\View\Event;

use Illuminate\View\View;

/**
 * Class ViewComposed
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewComposed
{

    /**
     * The view object.
     *
     * @var View
     */
    protected $view;

    /**
     * Create a new ViewComposed instance.
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Get the view.
     *
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }
}
