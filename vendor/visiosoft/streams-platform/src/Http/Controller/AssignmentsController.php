<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Form\AssignmentFormBuilder;
use Anomaly\Streams\Platform\Assignment\Table\AssignmentTableBuilder;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class AssignmentsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentsController extends AdminController
{

    /**
     * The stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * Return an index of existing assignments.
     *
     * @param  AssignmentTableBuilder    $table
     * @param  StreamRepositoryInterface $streams
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AssignmentTableBuilder $table, StreamRepositoryInterface $streams)
    {
        /* @var StreamInterface $stream */
        if (!$stream = $streams->find($this->route->parameter('stream'))) {
            $stream = $streams->findBySlugAndNamespace(
                $this->route->parameter('stream'),
                $this->getNamespace()
            );
        }

        return $table
            ->setStream($stream)
            ->render();
    }

    /**
     * Choose a field to assign.
     *
     * @param  FieldRepositoryInterface  $fields
     * @param  StreamRepositoryInterface $streams
     * @param ModuleCollection           $modules
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function choose(
        FieldRepositoryInterface $fields,
        StreamRepositoryInterface $streams,
        ModuleCollection $modules
    ) {
        $module = $modules->active();

        /* @var StreamInterface $stream */
        if (!$stream = $streams->find($this->route->parameter('stream'))) {
            $stream = $streams->findBySlugAndNamespace($this->route->parameter('stream'), $this->getNamespace());
        }

        $fields = $fields
            ->findAllByNamespace($this->getNamespace())
            ->notAssignedTo($stream)
            ->unlocked();

        return $this->view->make('streams::assignments/choose', compact('fields', 'module'));
    }

    /**
     * Create a new assignment.
     *
     * @param  AssignmentFormBuilder     $builder
     * @param  StreamRepositoryInterface $streams
     * @param  FieldRepositoryInterface  $fields
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(
        AssignmentFormBuilder $builder,
        StreamRepositoryInterface $streams,
        FieldRepositoryInterface $fields
    ) {
        /* @var StreamInterface $stream */
        if (!$stream = $streams->find($this->route->parameter('stream'))) {
            $stream = $streams->findBySlugAndNamespace($this->route->parameter('stream'), $this->getNamespace());
        }

        /* @var FieldInterface $field */
        $field = $fields->find($this->request->get('field'));

        return $builder
            ->setField($field)
            ->setStream($stream)
            ->render();
    }

    /**
     * Edit an existing assignment.
     *
     * @param  AssignmentFormBuilder $builder
     * @param  StreamRepositoryInterface $streams
     * @param AssignmentRepositoryInterface $assignments
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        AssignmentFormBuilder $builder,
        StreamRepositoryInterface $streams,
        AssignmentRepositoryInterface $assignments
    ) {
        /* @var StreamInterface $stream */
        if (!$stream = $streams->find($this->route->parameter('stream'))) {
            $stream = $streams->findBySlugAndNamespace($this->route->parameter('stream'), $this->getNamespace());
        }

        /* @var AssignmentInterface $assignment */
        $assignment = $assignments->find($this->route->parameter('id'));

        return $builder
            ->setStream($stream)
            ->setField($assignment->getField())
            ->render($assignment);
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}
