<?php namespace Anomaly\PreferencesModule\Http\Controller\Admin;

use Anomaly\PreferencesModule\Preference\Form\PreferenceFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class SystemController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SystemController extends AdminController
{

    /**
     * Return the form for editing preferences.
     *
     * @param  PreferenceFormBuilder                      $form
     * @param  Authorizer                                 $authorizer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PreferenceFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('anomaly.module.preferences::preferences.write')) {
            abort(403);
        }

        return $form->render('streams');
    }
}
