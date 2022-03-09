<?php namespace Anomaly\BlocksModule\Block\Form;

use Anomaly\BlocksModule\Area\Contract\AreaInterface;
use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class BlockFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\BlocksModule\Block\Form
 */
class BlockFormBuilder extends FormBuilder
{

    /**
     * The area instance.
     *
     * @var null|AreaInterface
     */
    protected $area = null;

    /**
     * The type instance.
     *
     * @var null|TypeInterface
     */
    protected $type = null;

    /**
     * The block field.
     *
     * @var null|FieldInterface $field
     */
    protected $field = null;

    /**
     * The block extension.
     *
     * @var null|BlockExtension
     */
    protected $extension = null;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'title',
        'display_title',
    ];

    /**
     * Fired just before
     * saving the form entry.
     */
    public function onSaving()
    {
        if ($area = $this->getArea()) {
            $this->setFormEntryAttribute('area', $area);
        }

        if ($type = $this->getType()) {
            $this->setFormEntryAttribute('type', $type);
        }

        if ($field = $this->getField()) {
            $this->setFormEntryAttribute('field', $field);
        }

        if ($extension = $this->getExtension()) {
            $this->setFormEntryAttribute('extension', $extension);
        }
    }

    /**
     * Get the area.
     *
     * @return EntryInterface|AreaInterface|null
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set the area.
     *
     * @param EntryInterface $area
     * @return $this
     */
    public function setArea(EntryInterface $area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get the type.
     *
     * @return null|TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param TypeInterface $type
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the field.
     *
     * @return FieldInterface|null
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the field.
     *
     * @param FieldInterface $field
     * @return $this
     */
    public function setField(FieldInterface $field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get the block extension.
     *
     * @return BlockExtension|null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set the block type.
     *
     * @param BlockExtension $extension
     * @return $this
     */
    public function setExtension(BlockExtension $extension)
    {
        $this->extension = $extension;

        return $this;
    }
}
