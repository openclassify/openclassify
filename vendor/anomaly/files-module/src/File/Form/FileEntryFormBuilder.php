<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class FileEntryFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileEntryFormBuilder extends MultipleFormBuilder
{

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'versions',
        'cancel',
        'view' => [
            'enabled' => 'edit',
            'target'  => '_blank',
            'href'    => 'admin/files/view/{request.route.parameters.id}',
        ],
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'breadcrumb' => 'streams::form.mode.edit',
    ];

    /**
     * Fired after the entry form is saved.
     *
     * After the entry form is saved take the
     * entry and use it to populate the page
     * before it saves directly after.
     *
     * @param EntryFormBuilder $builder
     */
    public function onSavedEntry(EntryFormBuilder $builder)
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('file');

        $file = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $file->entry_id   = $entry->getId();
        $file->entry_type = get_class($entry);
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('file');

        return $form->getContextualId();
    }
}
