<?php namespace Anomaly\Streams\Platform\Ui\Table;

use Anomaly\Streams\Platform\Support\Presenter;
use Illuminate\View\Factory;
use Illuminate\View\View;

/**
 * Class TablePresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TablePresenter extends Presenter
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $view;

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var Table
     */
    protected $object;

    /**
     * Create a new TablePresenter instance.
     *
     * @param Factory $view
     * @param $object
     */
    public function __construct(Factory $view, $object)
    {
        $this->view = $view;

        parent::__construct($object);
    }

    /**
     * Display the form content.
     *
     * @return string
     */
    public function __toString()
    {
        $content = $this->object->getContent();

        if ($content instanceof View) {
            return $content->render();
        }

        return (string)$content;
    }
}
