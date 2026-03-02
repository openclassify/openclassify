<?php namespace Visiosoft\AdvsModule\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

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
    private function getSlugLang($path, $seo = null){
        $enabled_langs = config('streams::locales.enabled');

        foreach ($enabled_langs as $lang) {
            $translatable_path = trans('visiosoft.module.advs::slug.detail_adv', [], $lang);
            if(!$seo){
                $translatable_path = trans('visiosoft.module.advs::slug.category', [], $lang);
            }
            if ($path == $translatable_path) {
                return $lang;
            }
        }
        return null;

    }
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request->route()->parameters;
        $seo = isset($parameters['seo']) ? $parameters['seo'] : null;
        $path = isset($parameters['path']) ? $parameters['path'] : null;

        if(!empty($parameters['city'])){
            $path = $parameters['category'];
            $seo = $parameters['city'];
        }

        $current_lang = $this->getSlugLang($path,  $seo);

        if($current_lang && (($request->session()->get('_locale') != $current_lang) or ($request->get('_setLang')))) {
            if ($request->get('_setLang')){
                $current_lang = $request->get('_setLang');
            }

            foreach (config('streams::locales.enabled') as $lang) {
                if ($path == trans('visiosoft.module.advs::slug.category', [], $lang)) {
                    $newPath = trans('visiosoft.module.advs::slug.category' , [], $current_lang);
                }elseif($path == trans('visiosoft.module.advs::slug.detail_adv', [], $lang) && $seo){
                    $newPath = trans('visiosoft.module.advs::slug.detail_adv' , [], $current_lang);
                }
            }

            $newUrl = Str::replaceFirst($path, $newPath, $request->path());
            $request->session()->put('_locale', $current_lang);
            return redirect($newUrl);
        }

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
