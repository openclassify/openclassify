<?php namespace Anomaly\PagesModule\Page\Form;

use Anomaly\PagesModule\Entry\Form\EntryFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;

/**
 * Class PageEntryFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageEntryFormBuilder extends MultipleFormBuilder
{

    /**
     * The form buttons.
     *
     * @var array
     */
    protected $buttons = [
        'versions',
        'cancel',
        'change' => [
            'enabled'     => 'edit',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'href'        => 'admin/pages/types/change/{request.route.parameters.id}',
        ],
        'view'   => [
            'enabled' => 'edit',
            'target'  => '_blank',
        ],
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
        $form = $this->forms->get('page');

        $page = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $page->entry_id   = $entry->getId();
        $page->entry_type = get_class($entry);
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('page');

        return $form->getContextualId();
    }

    /**
     * Load the entry off the versioned page.
     *
     * @param VersionInterface $version
     */
    public function onVersioning(VersionInterface $version)
    {
        $this->setChildFormEntry(
            'entry',
            $version
                ->getModel()
                ->getAttribute('entry')
        );
    }
}
