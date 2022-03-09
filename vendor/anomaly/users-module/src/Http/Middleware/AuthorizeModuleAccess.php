<?php namespace Anomaly\UsersModule\Http\Middleware;

use Anomaly\Streams\Platform\Addon\Module\ModuleCollection;
use Anomaly\Streams\Platform\Support\Authorizer;
use Closure;
use Illuminate\Http\Request;

/**
 * Class AuthorizeModuleAccess
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizeModuleAccess
{

    /**
     * The module collection.
     *
     * @var ModuleCollection
     */
    protected $modules;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new AuthorizeModuleAccess instance.
     *
     * @param ModuleCollection $modules
     * @param Authorizer       $authorizer
     */
    public function __construct(ModuleCollection $modules, Authorizer $authorizer)
    {
        $this->modules    = $modules;
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
        if ($request->segment(1) !== 'admin' || in_array($request->path(), ['admin/login', 'admin/logout', 'admin'])) {
            return $next($request);
        }

        $module = $this->modules->active();

        if ($module && !$this->authorizer->authorize($module->getNamespace('*'))) {
            abort(403);
        }

        return $next($request);
    }
}
