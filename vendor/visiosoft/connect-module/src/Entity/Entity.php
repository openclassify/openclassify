<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Button\ButtonCollection;
use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\ActionCollection;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Contract\ActionInterface;
use Anomaly\Streams\Platform\Ui\Entity\Component\Field\FieldCollection;
use Anomaly\Streams\Platform\Ui\Entity\Component\Section\SectionCollection;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;
use Robbo\Presenter\PresentableInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Entity
 *

 * @package Anomaly\Streams\Platform\Ui\Entity
 */
class Entity implements PresentableInterface
{

    /**
     * The entity model.
     *
     * @var null|mixed
     */
    protected $model = null;

    /**
     * The entity stream.
     *
     * @var null|StreamInterface
     */
    protected $stream = null;

    /**
     * The entity entry.
     *
     * @var mixed
     */
    protected $entry = null;

    /**
     * The entity content.
     *
     * @var null|string
     */
    protected $content = null;

    /**
     * The entity response.
     *
     * @var null|Response
     */
    protected $response = null;

    /**
     * The entity model. This is set
     * to create / edit automatically.
     *
     * @var null|string
     */
    protected $mode = null;

    /**
     * The entity data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * The entity errors.
     *
     * @var MessageBag
     */
    protected $errors;

    /**
     * The entity values.
     *
     * @var Collection
     */
    protected $values;

    /**
     * The entity fields.
     *
     * @var FieldCollection
     */
    protected $fields;

    /**
     * The entity options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * The entity actions.
     *
     * @var ActionCollection
     */
    protected $actions;

    /**
     * The entity buttons.
     *
     * @var ButtonCollection
     */
    protected $buttons;

    /**
     * The entity sections.
     *
     * @var SectionCollection
     */
    protected $sections;

    /**
     * Create a new Entity instance.
     *
     * @param Collection        $data
     * @param Collection        $values
     * @param Collection        $options
     * @param MessageBag        $errors
     * @param FieldCollection   $fields
     * @param ActionCollection  $actions
     * @param ButtonCollection  $buttons
     * @param SectionCollection $sections
     */
    public function __construct(
        Collection $data,
        Collection $values,
        Collection $options,
        MessageBag $errors,
        FieldCollection $fields,
        ActionCollection $actions,
        ButtonCollection $buttons,
        SectionCollection $sections
    ) {
        $this->data     = $data;
        $this->values   = $values;
        $this->fields   = $fields;
        $this->errors   = $errors;
        $this->actions  = $actions;
        $this->buttons  = $buttons;
        $this->options  = $options;
        $this->sections = $sections;
    }

    /**
     * Set the entity response.
     *
     * @param null|false|Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get the entity response.
     *
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the errors.
     *
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the errors.
     *
     * @param MessageBag $errors
     * @return $this
     */
    public function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * Return whether the entity has errors or not.
     *
     * @return bool
     */
    public function hasErrors()
    {
        return !$this->errors->isEmpty();
    }

    /**
     * Set the model object.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model object.
     *
     * @return null|EloquentModel|EntryModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the entity stream.
     *
     * @param StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get the entity stream.
     *
     * @return null|StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the entry.
     *
     * @param mixed $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the entry.
     *
     * @return EloquentModel|EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the entity content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the entity content.
     *
     * @return null|View
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add an action to the actions collection.
     *
     * @param ActionInterface $action
     * @return $this
     */
    public function addAction(ActionInterface $action)
    {
        $this->actions->put($action->getSlug(), $action);

        return $this;
    }

    /**
     * Set the entity actions.
     *
     * @param ActionCollection $actions
     * @return $this
     */
    public function setActions(ActionCollection $actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Get the entity actions.
     *
     * @return ActionCollection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Add a button to the buttons collection.
     *
     * @param ButtonInterface $button
     * @return $this
     */
    public function addButton(ButtonInterface $button)
    {
        $this->buttons->push($button);

        return $this;
    }

    /**
     * Set the entity buttons.
     *
     * @param ButtonCollection $buttons
     * @return $this
     */
    public function setButtons(ButtonCollection $buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get the entity buttons.
     *
     * @return ButtonCollection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the options.
     *
     * @param Collection $options
     * @return $this
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the options.
     *
     * @return Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set an option.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        $this->options->put($key, $value);

        return $this;
    }

    /**
     * Get an option value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        return $this->options->get($key, $default);
    }

    /**
     * Get the sections.
     *
     * @return SectionCollection
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections.
     *
     * @param SectionCollection $sections
     * @return $this
     */
    public function setSections(SectionCollection $sections)
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Add a section.
     *
     * @param $slug
     * @param $section
     * @return $this
     */
    public function addSection($slug, $section)
    {
        $this->sections->put($slug, $section);

        return $this;
    }

    /**
     * Add a field to the collection of fields.
     *
     * @param FieldType $field
     * @return $this
     */
    public function addField(FieldType $field)
    {
        $this->fields->push($field);

        return $this;
    }

    /**
     * Remove a field.
     *
     * @param $field
     * @return $this
     */
    public function removeField($field)
    {
        $this->fields->forget($field);

        return $this;
    }

    /**
     * Disable a field.
     *
     * @param $field
     * @return $this
     */
    public function disableField($field)
    {
        $field = $this->getField($field);

        $field->setDisabled(true);

        return $this;
    }

    /**
     * Set the entity views.
     *
     * @param Collection $fields
     * @return $this
     */
    public function setFields(Collection $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get the entity fields.
     *
     * @return FieldCollection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the enabled fields.
     *
     * @return FieldCollection
     */
    public function getEnabledFields()
    {
        return $this->fields->enabled();
    }

    /**
     * Get a entity field.
     *
     * @param $fieldSlug
     * @return FieldType|mixed
     */
    public function getField($fieldSlug)
    {
        return $this->fields->get($fieldSlug);
    }

    /**
     * Add data to the view data collection.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value)
    {
        $this->data->put($key, $value);

        return $this;
    }

    /**
     * Set the entity data.
     *
     * @param Collection $data
     * @return $this
     */
    public function setData(Collection $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the entity data.
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set a value on the value collection.
     *
     * @param $key
     * @param $value
     */
    public function setValue($key, $value)
    {
        $this->values->put($key, $value);
    }

    /**
     * Get a value from the value collection.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getValue($key, $default = null)
    {
        return $this->values->get($key, $default);
    }

    /**
     * Set the entity values.
     *
     * @param Collection $values
     * @return $this
     */
    public function setValues(Collection $values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Get the entity values.
     *
     * @return Collection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Get the mode.
     *
     * @return null|string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set the mode.
     *
     * @param $mode
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Return whether the entity is translatable or not.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        $fields = $this->fields->translatable();

        return (!$fields->isEmpty());
    }

    /**
     * Reset field values.
     */
    public function resetFields()
    {
        /* @var FieldType $field */
        foreach ($this->getFields() as $field) {
            $field->setValue(null);
        }

        return $this;
    }

    /**
     * Return a created presenter.
     *
     * @return EntityPresenter
     */
    public function getPresenter()
    {
        $presenter = get_class($this) . 'Presenter';

        if (class_exists($presenter)) {
            return app()->make($presenter, ['object' => $this]);
        }

        return app()->make(EntityPresenter::class, ['object' => $this]);
    }
}
