<?php namespace Visiosoft\AdvsModule\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class SetLang
 */
class SetLang
{

    /**
     * The redirect utility.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * Create a new SetLocale instance.
     *
     * @param Redirector $redirect
     */
    public function __construct(
        Redirector $redirect
    )
    {
        $this->redirect = $redirect;
    }

    public function handle(Request $request, Closure $next)
    {

        if ($locale = $request->get('_setLang')) {
            if ($locale) {
                $request->session()->put('_locale', $locale);
            } else {
                $request->session()->remove('_locale');
            }

            return ($request->has('redirect')) ? $this->redirect->to($request->get('redirect')) : $this->redirect->back();
        }

        return $next($request);
    }
}
