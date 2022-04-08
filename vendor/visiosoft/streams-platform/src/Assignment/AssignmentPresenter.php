<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Model\EloquentPresenter;

/**
 * Class AssignmentPresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentPresenter extends EloquentPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var AssignmentInterface
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
                $this->requiredLabel($size),
                $this->uniqueLabel($size),
                $this->translatableLabel($size),
            ]
        );
    }

    /**
     * Return the required label.
     *
     * @param  string      $size
     * @return null|string
     */
    protected function requiredLabel($size = 'sm')
    {
        if ($this->object->isRequired()) {
            return '<span class="tag tag-danger tag-' . $size . '">' . trans(
                'streams::assignment.required.name'
            ) . '</span>';
        }

        return null;
    }

    /**
     * Return the unique label.
     *
     * @param  string      $size
     * @return null|string
     */
    protected function uniqueLabel($size = 'sm')
    {
        if ($this->object->isUnique()) {
            return '<span class="tag tag-primary tag-' . $size . '">' . trans(
                'streams::assignment.unique.name'
            ) . '</span>';
        }

        return null;
    }

    /**
     * Return the translatable label.
     *
     * @param  string      $size
     * @return null|string
     */
    protected function translatableLabel($size = 'sm')
    {
        if ($this->object->isTranslatable()) {
            return '<span class="tag tag-info tag-' . $size . '">' . trans(
                'streams::assignment.translatable.name'
            ) . '</span>';
        }

        return null;
    }
}
