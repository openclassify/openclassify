<?php namespace Anomaly\Streams\Platform\Stream\Form;

use Anomaly\Streams\Platform\Stream\StreamModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class StreamFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamFormBuilder extends FormBuilder
{

    /**
     * The stream prefix.
     *
     * @var null|string
     */
    protected $prefix = null;

    /**
     * The stream namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * The form model.
     *
     * @var StreamModel
     */
    protected $model = StreamModel::class;

    /**
     * The form fields.
     *
     * @var StreamFormFields
     */
    protected $fields = StreamFormFields::class;

    /**
     * Fired when making the form.
     */
    public function onMake()
    {
        if ($editor = $this->getFormField('config')) {
            $editor->setValue(json_encode($editor->getValue(), JSON_PRETTY_PRINT));
        }
    }

    /**
     * Fired just before saving.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();

        if ($prefix = $this->getPrefix()) {
            $entry->prefix = $prefix;
        }

        if ($namespace = $this->getNamespace()) {
            $entry->namespace = $namespace;
        }

        if ($editor = $this->getFormField('config')) {
            $this->setFormValue('config', json_decode($editor->getValue(), true));
        }
    }

    /**
     * Get the prefix.
     *
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set the prefix.
     *
     * @param $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the namespace.
     *
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set the namespace.
     *
     * @param $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
