<?php namespace Anomaly\PostsModule\Post\Form;

use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PostFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostFormBuilder extends FormBuilder
{

    /**
     * The post type.
     *
     * @var null|TypeInterface
     */
    protected $type = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'type',
        'entry',
        'str_id',
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a post.');
        }
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();
        $type  = $this->getType();

        if ($type) {
            $entry->type_id = $type->getId();
        }
    }

    /**
     * Get the type.
     *
     * @return TypeInterface|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param  TypeInterface $type
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }
}
