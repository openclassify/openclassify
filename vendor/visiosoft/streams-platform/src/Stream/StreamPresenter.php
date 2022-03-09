<?php namespace Anomaly\Streams\Platform\Stream;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Presenter;

/**
 * Class StreamPresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamPresenter extends Presenter
{

    /**
     * The stream interface.
     *
     * @var StreamInterface
     */
    protected $object;

    /**
     * Return the flag labels.
     *
     * @param  string $size
     * @return string
     */
    public function labels($size = 'sm')
    {
        return implode(
            ' ',
            [
                $this->translatableLabel($size),
                $this->versionableLabel($size),
                $this->trashableLabel($size),
                $this->sortableLabel($size),
            ]
        );
    }

    /**
     * Return the translatable label.
     *
     * @param  string $size
     * @return null|string
     */
    protected function translatableLabel($size = 'sm')
    {
        if ($this->object->isTranslatable()) {
            return '<span class="tag tag-info tag-' . $size . '">' . trans(
                'streams::field.translatable.name'
            ) . '</span>';
        }

        return null;
    }

    /**
     * Return the versionable label.
     *
     * @param  string $size
     * @return null|string
     */
    protected function versionableLabel($size = 'sm')
    {
        if ($this->object->isVersionable()) {
            return '<span class="tag tag-primary tag-' . $size . '">' . trans(
                    'streams::field.versionable.name'
                ) . '</span>';
        }

        return null;
    }

    /**
     * Return the trashable label.
     *
     * @param  string $size
     * @return null|string
     */
    protected function trashableLabel($size = 'sm')
    {
        if ($this->object->isTrashable()) {
            return '<span class="tag tag-danger tag-' . $size . '">' . trans(
                'streams::field.trashable.name'
            ) . '</span>';
        }

        return null;
    }

    /**
     * Return the sortable label.
     *
     * @param  string $size
     * @return null|string
     */
    protected function sortableLabel($size = 'sm')
    {
        if ($this->object->isSortable()) {
            return '<span class="tag tag-primary tag-' . $size . '">' . trans(
                'streams::field.sortable.name'
            ) . '</span>';
        }

        return null;
    }
}
