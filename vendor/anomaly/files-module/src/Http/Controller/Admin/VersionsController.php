<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\FileModel;

/**
 * Class VersionsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionsController extends \Anomaly\Streams\Platform\Http\Controller\VersionsController
{

    /**
     * The versioned model.
     *
     * @var string
     */
    protected $model = FileModel::class;

}
