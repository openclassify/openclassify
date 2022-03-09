<?php namespace Anomaly\PagesModule\Http\Controller\Admin;

use Anomaly\PagesModule\Page\PageModel;

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
     * The versionable model.
     *
     * @var string
     */
    protected $model = PageModel::class;
}
