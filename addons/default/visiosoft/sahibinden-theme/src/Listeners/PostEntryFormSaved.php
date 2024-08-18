<?php namespace Visiosoft\SahibindenTheme\Listeners;

use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;

/**
 * This class written for save post tags as slugified.
 */
class PostEntryFormSaved
{

    public function handle(FormWasSaved $event)
    {
        $builder = $event->getBuilder();
        $formModel = $builder->getFormModel();
        if (isset($formModel) && $formModel->getStream() !== null &&$formModel->getStreamNamespace() == 'posts') {
            $entries = $builder->getParentBuilder()->getFormEntry();

            if (isset($entries) && $entries->getAttribute('tags')) {
                $tags = $entries->getAttribute('tags');
                foreach ($tags as $key => $value) {
                    $tags[$key] = str_slug($value);
                }

                $entries->setAttribute('tags',$tags );
                $entry = $builder->getFormEntry();
                $entry->save();
            }

        }

    }


}