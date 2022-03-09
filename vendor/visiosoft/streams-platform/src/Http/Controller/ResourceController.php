<?php namespace Anomaly\Streams\Platform\Http\Controller;

use Anomaly\Streams\Platform\Http\Middleware\VerifyCsrfToken;

/**
 * Class ResourceController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ResourceController extends PublicController
{

    /**
     * Create a new ResourceController instance.
     */
    public function __construct()
    {
        parent::__construct();

        // No CSRF protection.
        $this->middleware = array_filter(
            $this->middleware,
            function ($item) {
                return $item['middleware'] != VerifyCsrfToken::class;
            }
        );
    }
}
