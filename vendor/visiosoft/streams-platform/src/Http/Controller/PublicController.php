<?php namespace Anomaly\Streams\Platform\Http\Controller;

/**
 * Class PublicController
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class PublicController extends BaseController
{

    /**
     * Create a new BaseController instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('Anomaly\Streams\Platform\Http\Middleware\CheckForMaintenanceMode');
    }
}
