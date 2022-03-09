<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;
use Anomaly\Streams\Platform\Ui\Entity\Command\AddAssets;
use Anomaly\Streams\Platform\Ui\Entity\Command\BuildEntity;
use Anomaly\Streams\Platform\Ui\Entity\Command\LoadEntity;
use Anomaly\Streams\Platform\Ui\Entity\Command\MakeEntity;
use Anomaly\Streams\Platform\Ui\Entity\Command\PopulateFields;
use Anomaly\Streams\Platform\Ui\Entity\Command\PostEntity;
use Anomaly\Streams\Platform\Ui\Entity\Command\SaveEntity;
use Anomaly\Streams\Platform\Ui\Entity\Command\SetEntityResponse;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\ActionCollection;
use Anomaly\Streams\Platform\Ui\Entity\Contract\EntityRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EntityBuilder
 *

 * @package Anomaly\Streams\Platform\Ui\Entity
 */
class EntityBuilder
{

    use DispatchesJobs;
    use FiresCallbacks;

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = false;

    /**
     * The entity handler.
     *
     * @var null|string
     */
    protected $handler = null;

    /**
     * The entity validator.
     *
     * @var null|string
     */
    protected $validator = null;

    /**
     * The entity repository.
     *
     * @var null|EntityRepositoryInterface
     */
    protected $repository = null;

    /**
     * The entity model.
     *
     * @var null
     */
    protected $model = null;

    /**
     * The entry object.
     *
     * @var null|int
     */
    protected $entry = null;

    /**
     * The fields config.
     *
     * @var array|string
     */
    protected $fields = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The actions config.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The buttons config.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The entity options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The entity sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The entity assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * The save flag.
     *
     * @var bool
     */
    protected $save = true;

    /**
     * The entity object.
     *
     * @var Entity
     */
    protected $entity;

    /**
     * Crate a new EntityBuilder instance.
     *
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * Build the entity.
     *
     * @param null $entry
     * @return $this
     */
    public function build($entry = null)
    {
        if ($entry) {
            $this->entry = $entry;
        }

        $this->fire('ready', ['builder' => $this]);

        $this->dispatch(new BuildEntity($this));

        return $this;
    }

    /**
     * Make the entity.
     *
     * @param null $entry
     * @return $this
     */
    public function make($entry = null)
    {
        $this->build($entry);
        $this->post();

        if ($this->getEntityResponse() === null) {
            $this->dispatch(new LoadEntity($this));
            $this->dispatch(new AddAssets($this));
            $this->dispatch(new MakeEntity($this));
        }

        return $this;
    }

    /**
     * Handle the entity post.
     *
     * @param null $entry
     * @throws \Exception
     */
    public function handle($entry = null)
    {
        if (!app('request')->isMethod('post')) {
            throw new \Exception('The handle method must be used with a POST request.');
        }

        $this->build($entry);
        $this->post();
    }

    /**
     * Trigger post operations
     * for the entity.
     *
     * @return $this
     */
    public function post()
    {
        if (app('request')->isMethod('post')) {
            $this->dispatch(new PostEntity($this));
        } else {
            $this->dispatch(new PopulateFields($this));
        }

        return $this;
    }

    /**
     * Render the entity.
     *
     * @param  null $entry
     * @return Response
     */
    public function render($entry = null)
    {
        $this->make($entry);

        if (!$this->entity->getResponse()) {
            $this->dispatch(new SetEntityResponse($this));
        }

        return $this->entity->getResponse();
    }

    /**
     * Fire field events.
     *
     * @param       $trigger
     * @param array $payload
     */
    public function fireFieldEvents($trigger, array $payload = [])
    {
        /* @var FieldType $field */
        foreach ($this->getEntityFields() as $field) {
            $field->fire($trigger, array_merge(['builder' => $this], $payload));
        }
    }

    /**
     * Save the entity.
     */
    public function saveEntity()
    {
        $this->dispatch(new SaveEntity($this));
    }

    /**
     * Get the entity object.
     *
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Get the entity presenter.
     *
     * @return EntityPresenter
     */
    public function getEntityPresenter()
    {
        return $this->entity->getPresenter();
    }

    /**
     * Get the ajax flag.
     *
     * @return bool
     */
    public function isAjax()
    {
        return $this->ajax;
    }

    /**
     * Set the ajax flag.
     *
     * @param $ajax
     * @return $this
     */
    public function setAjax($ajax)
    {
        $this->ajax = $ajax;

        return $this;
    }

    /**
     * Get the handler.
     *
     * @return null|string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Set the handler.
     *
     * @param $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * Get the validator.
     *
     * @return null|string
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * Set the validator.
     *
     * @param $validator
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Get the repository.
     *
     * @return EntityRepositoryInterface|null
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the entity repository.
     *
     * @param EntityRepositoryInterface $repository
     * @return $this
     */
    public function setRepository(EntityRepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Set the entity model.
     *
     * @param  $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the entity model.
     *
     * @return null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the entry object.
     *
     * @param  $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the entry object.
     *
     * @return null|EntryInterface|FieldInterface|mixed
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the fields.
     *
     * @param  $fields
     * @return $this
     */
    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add a field.
     *
     * @param $field
     */
    public function addField($field)
    {
        $this->fields[] = $field;
    }

    /**
     * Get the skipped fields.
     *
     * @return array
     */
    public function getSkips()
    {
        return $this->skips;
    }

    /**
     * Set the skipped fields.
     *
     * @param $skips
     * @return $this
     */
    public function setSkips($skips)
    {
        $this->skips = $skips;

        return $this;
    }

    /**
     * Add a skipped field.
     *
     * @param $fieldSlug
     * @return $this
     */
    public function skipField($fieldSlug)
    {
        $this->skips[] = $fieldSlug;

        return $this;
    }

    /**
     * Set the actions config.
     *
     * @param  $actions
     * @return $this
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * Add an action.
     *
     * @param       $slug
     * @param array $definition
     * @return $this
     */
    public function addAction($slug, array $definition = [])
    {
        if ($definition) {
            $this->actions[$slug] = $definition;
        } else {
            $this->actions[] = $slug;
        }

        return $this;
    }

    /**
     * Get the actions config.
     *
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set the buttons config.
     *
     * @param  $buttons
     * @return $this
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get the buttons config.
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * The the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param array|string $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the sections.
     *
     * @return array
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections.
     *
     * @param array $sections
     * @return $this
     */
    public function setSections($sections)
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Add a section.
     *
     * @param       $slug
     * @param array $section
     * @return $this
     */
    public function addSection($slug, array $section)
    {
        array_set($this->sections, $slug, $section);

        return $this;
    }

    /**
     * Add a section tab.
     *
     * @param       $section
     * @param       $slug
     * @param array $tab
     */
    public function addSectionTab($section, $slug, array $tab)
    {
        array_set($this->sections, "{$section}.tabs.{$slug}", $tab);

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
        return array_get($this->options, $key, $default);
    }

    /**
     * Set an option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        array_set($this->options, $key, $value);

        return $this;
    }

    /**
     * Get the assets.
     *
     * @return array
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * Set the assets.
     *
     * @param $assets
     * @return $this
     */
    public function setAssets($assets)
    {
        $this->assets = $assets;

        return $this;
    }

    /**
     * Add an asset.
     *
     * @param $collection
     * @param $asset
     * @return $this
     */
    public function addAsset($collection, $asset)
    {
        if (!isset($this->assets[$collection])) {
            $this->assets[$collection] = [];
        }

        $this->assets[$collection][] = $asset;

        return $this;
    }

    /**
     * Get the entity's stream.
     *
     * @return StreamInterface|null
     */
    public function getEntityStream()
    {
        return $this->entity->getStream();
    }

    /**
     * Get a entity option value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getEntityOption($key, $default = null)
    {
        return $this->entity->getOption($key, $default);
    }

    /**
     * Set a entity option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setEntityOption($key, $value)
    {
        $this->entity->setOption($key, $value);

        return $this;
    }

    /**
     * Get the entity options.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getEntityOptions()
    {
        return $this->entity->getOptions();
    }

    /**
     * Get the entity model.
     *
     * @return \Anomaly\Streams\Platform\Entry\EntryModel|EloquentModel|null
     */
    public function getEntityModel()
    {
        return $this->entity->getModel();
    }

    /**
     * Get the entity entry.
     *
     * @return EloquentModel|EntryInterface|FieldInterface|AssignmentInterface
     */
    public function getEntityEntry()
    {
        return $this->entity->getEntry();
    }

    /**
     * Return the entity entry's ID.
     *
     * @return int|mixed|null
     */
    public function getEntityEntryId()
    {
        $entry = $this->getEntityEntry();

        return $entry->getId();
    }

    /**
     * Get the entity mode.
     *
     * @return null|string
     */
    public function getEntityMode()
    {
        return $this->entity->getMode();
    }

    /**
     * Set the entity mode.
     *
     * @param $mode
     * @return $this
     */
    public function setEntityMode($mode)
    {
        $this->entity->setMode($mode);

        return $this;
    }

    /**
     * Get a entity value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getEntityValue($key, $default = null)
    {
        return $this->entity->getValue($key, $default);
    }

    /**
     * Set a entity value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setEntityValue($key, $value)
    {
        $this->entity->setValue($key, $value);

        return $this;
    }

    /**
     * Get the entity values.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getEntityValues()
    {
        return $this->entity->getValues();
    }

    /**
     * Reset the entity.
     *
     * @return $this
     */
    public function resetEntity()
    {
        $this->entity
            ->resetFields()
            ->setValues(new Collection());

        return $this;
    }

    /**
     * Get the entity input.
     *
     * @return array
     */
    public function getEntityInput()
    {
        $values = $this->getEntityValues();

        return $values->all();
    }

    /**
     * Get the entity data.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getEntityData()
    {
        return $this->entity->getData();
    }

    /**
     * Ge the entity response.
     *
     * @return null|Response
     */
    public function getEntityResponse()
    {
        return $this->entity->getResponse();
    }

    /**
     * Set the entity response.
     *
     * @param null|false|Response $response
     * @return $this
     */
    public function setEntityResponse(Response $response)
    {
        $this->entity->setResponse($response);

        return $this;
    }

    /**
     * Get the entity content.
     *
     * @return null|string
     */
    public function getEntityContent()
    {
        return $this->entity->getContent();
    }

    /**
     * Get the entity fields.
     *
     * @return Component\Field\FieldCollection
     */
    public function getEntityFields()
    {
        return $this->entity->getFields();
    }

    /**
     * Get the enabled entity fields.
     *
     * @return Component\Field\FieldCollection
     */
    public function getEnabledEntityFields()
    {
        return $this->entity->getEnabledFields();
    }

    /**
     * Get the entity field.
     *
     * @param $fieldSlug
     * @return FieldType
     */
    public function getEntityField($fieldSlug)
    {
        return $this->entity->getField($fieldSlug);
    }

    /**
     * Disable a entity field.
     *
     * @param $fieldSlug
     * @return FieldType
     */
    public function disableEntityField($fieldSlug)
    {
        return $this->entity->disableField($fieldSlug);
    }

    /**
     * Get the entity field slugs.
     *
     * @return Array
     */
    public function getEntityFieldSlugs()
    {
        $fields = $this->entity->getFields();

        return $fields->lists('field')->all();
    }

    /**
     * Get the entity field names.
     *
     * @return Array
     */
    public function getEntityFieldNames()
    {
        $fields = $this->entity->getFields();

        return $fields->lists('field_name')->all();
    }

    /**
     * Add a entity field.
     *
     * @param FieldType $field
     * @return $this
     */
    public function addEntityField(FieldType $field)
    {
        $this->entity->addField($field);

        return $this;
    }

    /**
     * Set the entity errors.
     *
     * @param MessageBag $errors
     * @return $this
     */
    public function setEntityErrors(MessageBag $errors)
    {
        $this->entity->setErrors($errors);

        return $this;
    }

    /**
     * Get the entity errors.
     *
     * @return null|MessageBag
     */
    public function getEntityErrors()
    {
        return $this->entity->getErrors();
    }

    /**
     * Add an error to the entity.
     *
     * @param $field
     * @param $message
     * @return $this
     */
    public function addEntityError($field, $message)
    {
        $errors = $this->getEntityErrors();

        $errors->add($field, $message);

        return $this;
    }

    /**
     * Return whether the entity has errors or not.
     *
     * @return bool
     */
    public function hasEntityErrors()
    {
        $errors = $this->entity->getErrors();

        return !$errors->isEmpty();
    }

    /**
     * Get the entity actions.
     *
     * @return ActionCollection
     */
    public function getEntityActions()
    {
        return $this->entity->getActions();
    }

    /**
     * Add a entity button.
     *
     * @param ButtonInterface $button
     * @return $this
     */
    public function addEntityButton(ButtonInterface $button)
    {
        $this->entity->addButton($button);

        return $this;
    }

    /**
     * Add a entity section.
     *
     * @param       $slug
     * @param array $section
     * @return $this
     */
    public function addEntitySection($slug, array $section)
    {
        $this->entity->addSection($slug, $section);

        return $this;
    }

    /**
     * Set the entity entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntityEntry($entry)
    {
        $this->entity->setEntry($entry);

        return $this;
    }

    /**
     * Get a request value.
     *
     * @param      $key
     * @param null $default
     * @return mixed
     */
    public function getRequestValue($key, $default = null)
    {
        return array_get($_REQUEST, $this->getOption('prefix') . $key, $default);
    }

    /**
     * Set the save flag.
     *
     * @param bool $save
     * @return $this
     */
    public function setSave($save)
    {
        $this->save = $save;

        return $this;
    }

    /**
     * Return the save flag.
     *
     * @return bool
     */
    public function canSave()
    {
        return $this->save;
    }
}
