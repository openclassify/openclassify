<?php namespace Anomaly\PostsModule\Post\Form;

use Anomaly\PostsModule\Entry\Form\EntryFormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class PostEntryFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostEntryFormBuilder extends MultipleFormBuilder
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
            'href'        => 'admin/posts/change/{request.route.parameters.id}',
        ],
        'view'   => [
            'enabled' => 'edit',
            'target'  => '_blank',
            'href'    => 'admin/posts/view/{request.route.parameters.id}',
        ],
    ];

    /**
     * Fired after the entry form is saved.
     *
     * After the entry form is saved take the
     * entry and use it to populate the post
     * before it saves directly after.
     *
     * @param EntryFormBuilder $builder
     */
    public function onSavedEntry(EntryFormBuilder $builder)
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('post');

        $post = $form->getFormEntry();

        $entry = $builder->getFormEntry();

        $post->entry_id   = $entry->getId();
        $post->entry_type = get_class($entry);
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('post');

        return $form->getContextualId();
    }
}
