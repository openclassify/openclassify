<?php namespace Visiosoft\AdvsModule\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class SetLang
 */
class redirectDiffrentLang
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
        $original_url = $request->server->get('ORIGINAL_REQUEST_URI');
        $setting_language = setting_value('streams::default_locale');
        $current_language = $request->session()->get('_locale', $setting_language);
        $request_url = ltrim($request->getRequestUri(), '/');
        if ($current_language != $setting_language) {
            if ($request_url != "" and $original_url != '/' . $current_language . '/' . $request_url) {
                return $this->redirect->to('/' . $current_language . '/' . $request_url);
            }
        } else {
            if ($request_url == "" and '/' . $current_language != $original_url) {
                $this->redirect->to($current_language);
            }
        }

        return $next($request);
    }
}
