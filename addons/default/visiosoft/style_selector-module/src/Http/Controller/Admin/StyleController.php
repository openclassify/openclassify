<?php namespace Visiosoft\StyleSelectorModule\Http\Controller\Admin;

use Visiosoft\StyleSelectorModule\Style\Form\StyleFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class StyleController extends AdminController
{
    public function selector(StyleFormBuilder $form)
    {
        return $form->render();
    }
}
