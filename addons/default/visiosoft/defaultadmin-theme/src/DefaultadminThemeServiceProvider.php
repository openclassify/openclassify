<?php namespace Visiosoft\DefaultadminTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event\SortNavigation;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Illuminate\Pagination\AbstractPaginator;
use Visiosoft\DefaultadminTheme\Listener\AddGsmFilter;
use Visiosoft\DefaultadminTheme\Listener\AddViewAdsButton;
use Visiosoft\DefaultadminTheme\Listener\ApplySorting;

/**
 * Class DefaultadminThemeServiceProvider
 *
 * @link   http://openclassify.com/
 * @author OpenClassify, Inc. <support@openclassify.com>
 * @author Vedat Akdogan <vedat@openclassify.com>
 */
class DefaultadminThemeServiceProvider extends AddonServiceProvider
{
    protected $listeners = [
        SortNavigation::class => [
            ApplySorting::class,
        ],
        TableIsQuerying::class => [
            AddGsmFilter::class,
            AddViewAdsButton::class
        ],
    ];

    protected $overrides = [
	    'streams::table/partials/footer' => 'visiosoft.theme.defaultadmin::table/partials/footer'
    ];

    public function register()
    {
        AbstractPaginator::$defaultView       = 'visiosoft.theme.defaultadmin::pagination/bootstrap-4';
        AbstractPaginator::$defaultSimpleView = 'streams::pagination/simple-bootstrap-4';
    }
    public function getOverrides()
    {
        $request = app('Illuminate\Http\Request');

        if ($request->segment(2) === "users") {
            return [
                'streams::form/partials/tabs' => 'visiosoft.theme.defaultadmin::form/partials/tabs',
            ];
        }

        return parent::getOverrides();
    }
}
