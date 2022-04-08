<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Version\Table\VersionTableBuilder;

/**
 * Class VersionsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionsController extends AdminController
{

    /**
     * The versioned model.
     *
     * @var null|string
     */
    protected $model = null;

    /**
     * Return an index of existing assignments.
     *
     * @param  VersionTableBuilder $table
     * @param                      $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VersionTableBuilder $table)
    {
        return $table
            ->setType($this->getModel())
            ->setId($this->request->route('id'))
            ->render();
    }

    /**
     * Get the model.
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the prefix.
     *
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

}
