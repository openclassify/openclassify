<?php namespace Anomaly\PagesModule\Page\Form;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PageFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageFormBuilder extends FormBuilder
{

    /**
     * The page type.
     *
     * @var null|TypeInterface
     */
    protected $type = null;

    /**
     * The parent page.
     *
     * @var null|PageInterface
     */
    protected $parent = null;

    /**
     * Skip these fields.
     *
     * @var array
     */
    protected $skips = [
        'str_id',
        'path',
        'type',
        'entry',
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a page.');
        }
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $parent = $this->getParent();
        $type   = $this->getType();

        if ($type) {
            $entry->type_id = $type->getId();
        }

        if ($parent) {
            $entry->parent_id = $parent->getId();
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

    /**
     * Get the parent page.
     *
     * @return null|PageInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent page.
     *
     * @param  PageInterface $parent
     * @return $this
     */
    public function setParent(PageInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
