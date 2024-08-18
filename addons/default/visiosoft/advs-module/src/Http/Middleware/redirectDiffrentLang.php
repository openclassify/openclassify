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
        if (setting_value('visiosoft.module.advs::show_lang_url')) {
            $original_url = $request->server->get('ORIGINAL_REQUEST_URI');
            $setting_language = setting_value('streams::default_locale');
            $current_language = $request->session()->get('_locale', $setting_language);
            $request_url = ltrim($request->getRequestUri(), '/');

            $not_included = [
                'admin',
                'social'
            ];

            // If the segment(1) is admin and language parameters is not null, no forwarding will be made.
            if (in_array($request->segment(1), $not_included) and in_array($current_language, explode('/', $original_url))) {
                return $this->redirect->to($request->fullUrl());
            }

            if ($current_language != $setting_language) {

                // If the method is get, no forwarding will be made.
                // If the segment(1) is admin, no forwarding will be made.

                if ($request->method() == "GET" and !in_array($request->segment(1), $not_included) and $request_url != "" and $original_url != '/' . $current_language . '/' . $request_url) {
                    return $this->redirect->to('/' . $current_language . '/' . $request_url);
                }
            }
        }
        return $next($request);
    }
}
