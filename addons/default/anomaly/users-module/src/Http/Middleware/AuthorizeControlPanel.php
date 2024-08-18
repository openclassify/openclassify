<?php namespace Anomaly\UsersModule\Http\Middleware;

use Anomaly\Streams\Platform\Support\Authorizer;
use Closure;
use Illuminate\Http\Request;

/**
 * Class AuthorizeControlPanel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizeControlPanel
{

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new AuthorizeControlPanel instance.
     *
     * @param Authorizer $authorizer
     */
    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    /**
     * Check the authorization of module access.
     *
     * @param  Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->segment(1) !== 'admin' || in_array($request->path(), ['admin/login', 'admin/logout'])) {
            return $next($request);
        }

        if (!$this->authorizer->authorize('streams::control_panel.access')) {
            abort(403);
        }

        return $next($request);
    }
}
