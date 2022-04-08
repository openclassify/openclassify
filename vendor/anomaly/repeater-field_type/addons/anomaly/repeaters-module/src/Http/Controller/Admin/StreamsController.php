<?php namespace Anomaly\RepeatersModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Form\StreamFormBuilder;
use Anomaly\Streams\Platform\Stream\Table\StreamTableBuilder;

/**
 * Class StreamsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamsController extends AdminController
{

    /**
     * Return an index of repeater streams.
     *
     * @param StreamTableBuilder $builder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(StreamTableBuilder $builder)
    {
        return $builder
            ->setNamespace('repeater')
            ->setButtons(
                [
                    'edit',
                    'assignments',
                ]
            )
            ->render();
    }

    /**
     * Create a new stream.
     *
     * @param StreamFormBuilder $builder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(StreamFormBuilder $builder)
    {
        return $builder
            ->setPrefix('repeater_')
            ->setNamespace('repeater')
            ->setSkips(
                [
                    'title_column',
                    'searchable',
                    'trashable',
                    'sortable',
                    'config',
                ]
            )
            ->render();
    }

    /**
     * Edit an existing stream.
     *
     * @param StreamFormBuilder $builder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(StreamFormBuilder $builder)
    {
        return $builder
            ->setNamespace('repeater')
            ->setSkips(
                [
                    'title_column',
                    'searchable',
                    'trashable',
                    'sortable',
                    'config',
                ]
            )
            ->render($this->route->parameter('id'));
    }
}
