<?php namespace Anomaly\Streams\Platform\Http\Controller;

/**
 * Class AdminController
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AdminController extends BaseController
{

    /**
     * Create a new AdminController instance.
     */
    public function __construct()
    {

        /*
         * The authenticate middleware in
         * Laravel is re-bound in the Users
         * module unless you are not using
         * the core Users module.
         */
        $this->middleware('auth');

        parent::__construct();
    }
}
