<?php namespace Anomaly\PreferencesModule\Http\Controller\Admin;

use Anomaly\PreferencesModule\Preference\Form\PreferenceFormBuilder;
use Anomaly\PreferencesModule\Preference\Table\AddonTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class AddonsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsController extends AdminController
{

    /**
     * Return an index of addons with preferences.
     *
     * @param  AddonTableBuilder                          $table
     * @param  Authorizer                                 $authorizer
     * @param                                             $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AddonTableBuilder $table, Authorizer $authorizer, $type)
    {
        if (!$authorizer->authorize('anomaly.module.preferences::preferences.write')) {
            abort(403);
        }

        $table->setType($type);

        return $table->render();
    }

    /**
     * Return a form for editing preferences.
     *
     * @param  PreferenceFormBuilder                      $form
     * @param  Authorizer                                 $authorizer
     * @param                                             $type
     * @param                                             $addon
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PreferenceFormBuilder $form, Authorizer $authorizer, $type, $addon)
    {
        if (!$authorizer->authorize('anomaly.module.preferences::preferences.write')) {
            abort(403);
        }

        unset($type);

        return $form->render($addon);
    }
}
