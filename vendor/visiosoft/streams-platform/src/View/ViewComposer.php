<?php

namespace Anomaly\Streams\Platform\View;

use Mobile_Detect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\Support\Decorator;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\View\Event\ViewComposed;

/**
 * Class ViewComposer
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ViewComposer
{

    /**
     * The loaded flag.
     *
     * @var bool
     */
    protected static $loaded = false;

    /**
     * The agent utility.
     *
     * @var Mobile_Detect
     */
    protected $agent;

    /**
     * The current theme.
     *
     * @var Theme|null
     */
    protected $theme;

    /**
     * The active module.
     *
     * @var Module|null
     */
    protected $module;

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The view overrides collection.
     *
     * @var ViewOverrides
     */
    protected $overrides;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * The view mobile overrides.
     *
     * @var ViewMobileOverrides
     */
    protected $mobiles;

    /**
     * Create a new ViewComposer instance.
     *
     * @param Mobile_Detect $agent
     * @param AddonCollection $addons
     * @param ViewOverrides $overrides
     * @param Request $request
     * @param ViewMobileOverrides $mobiles
     * @param Application $application
     */
    public function __construct(
        Mobile_Detect $agent,
        AddonCollection $addons,
        ViewOverrides $overrides,
        Request $request,
        ViewMobileOverrides $mobiles,
        Application $application
    ) {
        $this->agent       = $agent;
        $this->addons      = $addons;
        $this->mobiles     = $mobiles;
        $this->request     = $request;
        $this->overrides   = $overrides;
        $this->application = $application;

        $area = $request->segment(1) == 'admin' ? 'admin' : 'standard';

        $this->theme  = $this->addons->themes->active($area);
        $this->module = $this->addons->modules->active();

        $this->mobile = $this->agent->isMobile();
    }

    /**
     * Compose the view before rendering.
     *
     * @param  View $view
     * @return View
     */
    public function compose(View $view)
    {
        if ($data = array_merge($view->getFactory()->getShared(), $view->getData())) {

            array_walk(
                $data,
                function (&$value) {
                    $value = (new Decorator())->decorate($value);
                }
            );

            /* @deprecated since 1.6; use template() helper/function instead. */
            $data['template'] = (new Decorator())->decorate(app(ViewTemplate::class));

            $view->with($data);
        }

        if (!$this->theme || !env('INSTALLED')) {

            // ensure we re-view compose on every testing run.
            if ((!self::$loaded && self::$loaded = true) || env('APP_ENV') === 'testing') {
                /* @deprecated since 1.6; this is no longer needed for every view. */
                event(new ViewComposed($view));
            }

            return $view;
        }

        $this->setPath($view);

        // ensure we re-view compose on every testing run.
        if ((!self::$loaded && self::$loaded = true) || env('APP_ENV') === 'testing') {
            /* @deprecated since 1.6; this is no longer needed for every view. */
            event(new ViewComposed($view));
        }

        return $view;
    }

    /**
     * Set the view path.
     *
     * @param View $view
     */
    protected function setPath(View $view)
    {
        $mobile = array_merge(
            $this->mobiles->all(),
            config('streams.mobile', [])
        );

        $overrides = array_merge(
            $this->overrides->all(),
            config('streams.overrides', [])
        );

        $name = str_replace('theme::', $this->theme->getNamespace() . '::', $view->getName());

        if ($this->mobile && $path = array_get($mobile, $name, null)) {
            $view->setPath(str_replace('theme::', $this->theme->getNamespace() . '::', $path));
        } elseif ($path = array_get($overrides, $name, null)) {
            $view->setPath(str_replace('theme::', $this->theme->getNamespace() . '::', $path));
        }

        /**
         * Get the overloaded view path.
         *
         * This is very expensive for IO
         * so we're going to remove it in
         * favor of manual overrides only.
         *
         * @deprecated since 1.6; Use override collection.
         */
        if (env('AUTOMATIC_ADDON_OVERRIDES', true) && $overload = $this->getOverloadPath($view)) {
            $view->setPath($overload);
        }
    }

    /**
     * Get the override view path.
     *
     * @param  $view
     * @return null|string
     */
    public function getOverloadPath(View $view)
    {

        /*
         * We can only overload namespaced
         * views right now.
         */
        if (!Str::contains($view->getName(), '::')) {
            return null;
        }

        /*
         * Split the view into it's
         * namespace and path.
         */
        list($namespace, $path) = explode('::', $view->getName());

        $override = null;

        $path = str_replace('.', '/', $path);

        /*
         * If the view is a streams view then
         * it's real easy to guess what the
         * override path should be.
         */
        if ($namespace == 'streams') {
            $override = $this->theme->getNamespace('streams/' . $path);
        }

        /*
         * If the view uses a dot syntax namespace then
         * transform it all into the override view path.
         */
        if ($addon = $this->addons->get($namespace)) {
            $override = $this->theme->getNamespace(
                "addons/{$addon->getVendor()}/{$addon->getSlug()}-{$addon->getType()}/" . $path
            );
        }

        if (view()->exists($override)) {
            return $override;
        }

        return null;
    }
}
