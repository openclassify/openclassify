<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Lock\Contract\LockInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;
use Anomaly\Streams\Platform\Ui\Form\Command\BuildForm;
use Anomaly\Streams\Platform\Ui\Form\Command\FlashFieldValues;
use Anomaly\Streams\Platform\Ui\Form\Command\FlashFormErrors;
use Anomaly\Streams\Platform\Ui\Form\Command\LoadForm;
use Anomaly\Streams\Platform\Ui\Form\Command\LoadFormValues;
use Anomaly\Streams\Platform\Ui\Form\Command\MakeForm;
use Anomaly\Streams\Platform\Ui\Form\Command\PopulateFields;
use Anomaly\Streams\Platform\Ui\Form\Command\PostForm;
use Anomaly\Streams\Platform\Ui\Form\Command\SaveForm;
use Anomaly\Streams\Platform\Ui\Form\Command\SetFormResponse;
use Anomaly\Streams\Platform\Ui\Form\Command\ValidateForm;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\ActionCollection;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionInterface;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Version\Contract\VersionInterface;
use Closure;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormBuilder
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
     * Set to false to disable
     * default versioning behavior.
     *
     * @var bool
     */
    protected $versioning = true;

    /**
     * The version instance.
     *
     * @var null|VersionInterface
     */
    protected $version = null;

    /**
     * The form handler.
     *
     * @var null|string
     */
    protected $handler = null;

    /**
     * The form validator.
     *
     * @var null|string
     */
    protected $validator = null;

    /**
     * The form repository.
     *
     * @var null|FormRepositoryInterface
     */
    protected $repository = null;

    /**
     * The form model.
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
     * Fields to rules.
     *
     * @var array|string
     */
    protected $rules = [];

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
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
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
     * The read only flag.
     *
     * @var bool
     */
    protected $readOnly = false;

    /**
     * The lock instance.
     *
     * @var LockInterface
     */
    protected $lock = null;

    /**
     * The lock flag.
     *
     * @var bool
     */
    protected $locked = false;

    /**
     * The parent form builder.
     *
     * @var null|FormBuilder
     */
    protected $parentBuilder = null;

    /**
     * The form object.
     *
     * @var Form
     */
    protected $form;

    /**
     * Crate a new FormBuilder instance.
     *
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Build the form.
     *
     * @param  null $entry
     * @return $this
     */
    public function build($entry = null)
    {
        if ($entry) {
            $this->entry = $entry;
        }

        $this->fire('ready', ['builder' => $this]);

        $this->dispatchNow(new BuildForm($this));

        $this->fire('built', ['builder' => $this]);

        return $this;
    }

    /**
     * Make the form.
     *
     * @param  null $entry
     * @return $this
     */
    public function make($entry = null)
    {
        $this->build($entry);
        $this->post();

        $this->fire('make', ['builder' => $this]);

        if ($this->getFormResponse() === null) {
            $this->dispatchNow(new LoadForm($this));
            $this->dispatchNow(new MakeForm($this));
        }

        return $this;
    }

    /**
     * Handle the form post.
     *
     * @param  null $entry
     * @return $this
     * @throws \Exception
     */
    public function handle($entry = null)
    {
        if (!app('request')->isMethod('post')) {
            throw new \Exception('The handle method must be used with a POST request.');
        }

        $this->build($entry);
        $this->post();

        return $this;
    }

    /**
     * Trigger post operations
     * for the form.
     *
     * @return $this
     */
    public function post()
    {
        if (app('request')->isMethod('post')) {
            $this->fire('post', ['builder' => $this]);

            if ($this->hasPostData() || $this->isAjax()) {
                $this->dispatchNow(new PostForm($this));
            }
        } else {
            $this->dispatchNow(new PopulateFields($this));
        }

        return $this;
    }

    /**
     * Validate the form.
     *
     * @return $this
     */
    public function validate()
    {
        $this->dispatchNow(new LoadFormValues($this));
        $this->dispatchNow(new ValidateForm($this));

        return $this;
    }

    /**
     * Flash form information to be
     * used in conjunction with redirect
     * type responses (not self handling).
     */
    public function flash()
    {
        $this->dispatchNow(new FlashFormErrors($this));
        $this->dispatchNow(new FlashFieldValues($this));
    }

    /**
     * Render the form.
     *
     * @param  null $entry
     * @return Response
     */
    public function render($entry = null)
    {
        $this->make($entry);

        if (!$this->form->getResponse()) {
            $this->dispatchNow(new SetFormResponse($this));
        }

        return $this->form->getResponse();
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
        foreach ($this->getFormFields() as $field) {
            $field->fire($trigger, array_merge(['builder' => $this], $payload));
        }
    }

    /**
     * Save the form.
     */
    public function saveForm()
    {
        $this->dispatchNow(new SaveForm($this));
    }

    /**
     * Get the form object.
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Get the form presenter.
     *
     * @return FormPresenter
     */
    public function getFormPresenter()
    {
        return $this->form->getPresenter();
    }

    /**
     * Touch the form entry.
     *
     * @return $this
     */
    public function touchFormEntry()
    {
        $entry = $this->getFormEntry();

        if ($entry instanceof EloquentModel) {

            $time = $entry->freshTimestamp();

            if (!is_null($entry::UPDATED_AT) && !$entry->isDirty($entry::UPDATED_AT)) {
                $entry->setUpdatedAt($time);
            }

            if (!$entry->exists && !$entry->isDirty($entry::CREATED_AT)) {
                $entry->setCreatedAt($time);
            }
        }

        return $this;
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
     * Return if the versioning
     * system is enabled or not.
     *
     * @return bool
     */
    public function versioningEnabled()
    {
        return $this->versioning === true;
    }

    /**
     * Disable the versioning system.
     *
     * @return $this
     */
    public function disableVersioning()
    {
        $this->versioning = false;

        return $this;
    }

    /**
     * Enable the versioning system.
     *
     * @return $this
     */
    public function enableVersioning()
    {
        $this->versioning = true;

        return $this;
    }

    /**
     * Get the version.
     *
     * @return VersionInterface|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version.
     *
     * @param VersionInterface $version
     * @return $this
     */
    public function setVersion(VersionInterface $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Return if a version is loaded or not.
     *
     * @return bool
     */
    public function hasVersion()
    {
        return (bool)$this->version;
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
     * @return FormRepositoryInterface|null
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Set the form repository.
     *
     * @param  FormRepositoryInterface $repository
     * @return $this
     */
    public function setRepository(FormRepositoryInterface $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * Set the form model.
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
     * Get the form model.
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
     * @param       $field
     * @param array $definition
     * @return $this
     */
    public function addField($field, array $definition = [])
    {
        if (!$definition) {
            $this->fields[array_get($field, 'field')] = $field;
        } else {
            $this->fields[$field] = $definition;
        }

        return $this;
    }

    /**
     * Add fields.
     *
     * @param array $fields
     */
    public function addFields(array $fields)
    {
        $this->fields = array_unique(array_merge($this->fields, $fields), SORT_REGULAR);
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
     * Merge in skipped fields.
     *
     * @param array $skips
     * @return $this
     */
    public function mergeSkips(array $skips)
    {
        $this->skips = array_merge($this->skips, $skips);

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
     * Set the rules.
     *
     * @param $rules
     * @return $this
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Add rules for a field.
     *
     * @param       $field
     * @param array $rules
     * @return $this
     */
    public function addRules($field, array $rules)
    {
        $this->rules[$field] = $rules;

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
     * @param        $slug
     * @param  array $definition
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
     * Add a button.
     *
     * @param       $button
     * @param array $definition
     * @return $this
     */
    public function addButton($button, array $definition = [])
    {
        if (!$definition) {
            $this->buttons[] = $button;
        } else {
            $this->buttons[$button] = $definition;
        }

        return $this;
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
     * @param  array|string $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Merge in options.
     *
     * @param  array|string $options
     * @return $this
     */
    public function mergeOptions($options)
    {
        $this->options = array_merge($this->options, $options);

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
     * @param  array|Closure $sections
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
     * @param        $slug
     * @param  array $section
     * @param null $position
     * @return $this
     */
    public function addSection($slug, array $section, $position = null)
    {
        if ($position === null) {
            $position = count($this->sections) + 1;
        }

        $front = array_slice($this->sections, 0, $position, true);
        $back  = array_slice($this->sections, $position, count($this->sections) - $position, true);

        $this->sections = $front + [$slug => $section] + $back;

        return $this;
    }

    /**
     * Merge in additional sections.
     *
     * @param array $sections
     * @return $this
     */
    public function mergeSections(array $sections)
    {
        $this->sections = array_merge($this->sections, $sections);

        return $this;
    }

    /**
     * Add a section tab.
     *
     * @param        $section
     * @param        $slug
     * @param  array $tab
     * @param null $position
     * @return $this
     */
    public function addSectionTab($section, $slug, array $tab, $position = null)
    {
        $tabs = (array)array_get($this->sections, "{$section}.tabs");

        if ($position === null) {
            $position = count($tabs) + 1;
        }

        $front = array_slice($tabs, 0, $position, true);
        $back  = array_slice($tabs, $position, count($tabs) - $position, true);

        $tabs = $front + [$slug => $tab] + $back;

        array_set($this->sections, "{$section}.tabs", $tabs);

        return $this;
    }

    /**
     * Recursively prefix all section fields.
     *
     * @param      $prefix
     * @param null $sections
     * @return array|null
     */
    public function prefixSectionFields($prefix, $sections = null)
    {
        if (!$sections) {
            $sections = &$this->sections;
        }

        if (!is_array($sections)) {
            return $sections;
        }

        foreach ($sections as $key => &$value) {
            if ($key === 'fields') {
                $value = array_map(
                    function ($field) use ($key, $prefix) {
                        return $prefix . $field;
                    },
                    array_values($value)
                );
            } elseif (is_array($value)) {
                $value = $this->prefixSectionFields($prefix, $value);
            }
        }

        return $sections;
    }

    /**
     * Get an option value.
     *
     * @param        $key
     * @param  null $default
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
     * Return if the form has an option.
     *
     * @param $key
     * @return bool
     */
    public function hasOption($key)
    {
        return array_key_exists($key, $this->options);
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
     * Get the form's stream.
     *
     * @return StreamInterface|null
     */
    public function getFormStream()
    {
        return $this->form->getStream();
    }

    /**
     * Get a form option value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function getFormOption($key, $default = null)
    {
        return $this->form->getOption($key, $default);
    }

    /**
     * Set a form option value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setFormOption($key, $value)
    {
        $this->form->setOption($key, $value);

        return $this;
    }

    /**
     * Get the form options.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getFormOptions()
    {
        return $this->form->getOptions();
    }

    /**
     * Get the form model.
     *
     * @return \Anomaly\Streams\Platform\Entry\EntryModel|EloquentModel|null
     */
    public function getFormModel()
    {
        return $this->form->getModel();
    }

    /**
     * Get the form model name.
     *
     * @return \Anomaly\Streams\Platform\Entry\EntryModel|EloquentModel|null
     */
    public function getFormModelName()
    {
        return get_class($this->form->getModel());
    }

    /**
     * Get the form entry.
     *
     * @return EloquentModel|EntryInterface|FieldInterface|AssignmentInterface
     */
    public function getFormEntry()
    {
        return $this->form->getEntry();
    }

    /**
     * Return the form entry's ID.
     *
     * @return int|mixed|null
     */
    public function getFormEntryId()
    {
        $entry = $this->getFormEntry();

        if (!$entry instanceof EloquentModel) {
            return null;
        }

        return $entry->getId();
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|null
     */
    public function getContextualId()
    {
        return $this->getFormEntryId();
    }

    /**
     * Get the form mode.
     *
     * @return null|string
     */
    public function getFormMode()
    {
        return $this->form->getMode();
    }

    /**
     * Set the form mode.
     *
     * @param $mode
     * @return $this
     */
    public function setFormMode($mode)
    {
        $this->form->setMode($mode);

        return $this;
    }

    /**
     * Get a form value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function getFormValue($key, $default = null)
    {
        return $this->form->getValue($key, $default);
    }

    /**
     * Set a form value.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setFormValue($key, $value)
    {
        $this->form->setValue($key, $value);

        return $this;
    }

    /**
     * Get the form values.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getFormValues()
    {
        return $this->form->getValues();
    }

    /**
     * Reset the form.
     *
     * @return $this
     */
    public function resetForm()
    {
        $this->form
            ->resetFields()
            ->setValues(new Collection());

        return $this;
    }

    /**
     * Get the form input.
     *
     * @return array
     */
    public function getFormInput()
    {
        $values = $this->getFormValues();

        return $values->all();
    }

    /**
     * Get the form data.
     *
     * @return \Anomaly\Streams\Platform\Support\Collection
     */
    public function getFormData()
    {
        return $this->form->getData();
    }

    /**
     * Add form data.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addFormData($key, $value)
    {
        $this->form->addData($key, $value);

        return $this;
    }

    /**
     * Ge the form response.
     *
     * @return null|Response
     */
    public function getFormResponse()
    {
        return $this->form->getResponse();
    }

    /**
     * Set the form response.
     *
     * @param  null|false|Response $response
     * @return $this
     */
    public function setFormResponse(Response $response)
    {
        $this->form->setResponse($response);

        return $this;
    }

    /**
     * Get the form content.
     *
     * @return null|string
     */
    public function getFormContent()
    {
        return $this->form->getContent();
    }

    /**
     * Get the form fields.
     *
     * @return Component\Field\FieldCollection
     */
    public function getFormFields()
    {
        return $this->form->getFields();
    }

    /**
     * Get the enabled form fields.
     *
     * @return Component\Field\FieldCollection
     */
    public function getEnabledFormFields()
    {
        return $this->form->getEnabledFields();
    }

    /**
     * Get the form field.
     *
     * @param $fieldSlug
     * @return FieldType
     */
    public function getFormField($fieldSlug)
    {
        return $this->form->getField($fieldSlug);
    }

    /**
     * Get the form attribute map.
     *
     * @return FieldType
     */
    public function getFormFieldFromAttribute($attribute)
    {
        /* @var FieldType $field */
        foreach ($this->form->getFields() as $field) {
            if ($field->getInputName() == $attribute) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Disable a form field.
     *
     * @param $fieldSlug
     * @return $this
     */
    public function disableFormField($fieldSlug)
    {
        $this->form->disableField($fieldSlug);

        return $this;
    }

    /**
     * Get the form field slugs.
     *
     * @param  null $prefix
     * @return array
     */
    public function getFormFieldSlugs($prefix = null)
    {
        $fields = $this->form->getFields();

        return array_map(
            function ($slug) use ($prefix) {
                return $prefix . $slug;
            },
            array_unique($fields->pluck('field')->all())
        );
    }

    /**
     * Get the form field names.
     *
     * @return array
     */
    public function getFormFieldNames()
    {
        $fields = $this->form->getFields();

        return $fields->pluck('field_name')->all();
    }

    /**
     * Add a form field.
     *
     * @param  FieldType $field
     * @return $this
     */
    public function addFormField(FieldType $field)
    {
        $this->form->addField($field);

        return $this;
    }

    /**
     * Set the form errors.
     *
     * @param  MessageBag $errors
     * @return $this
     */
    public function setFormErrors(MessageBag $errors)
    {
        $this->form->setErrors($errors);

        return $this;
    }

    /**
     * Get the form errors.
     *
     * @return null|MessageBag
     */
    public function getFormErrors()
    {
        return $this->form->getErrors();
    }

    /**
     * Add an error to the form.
     *
     * @param $field
     * @param $message
     * @return $this
     */
    public function addFormError($field, $message)
    {
        $errors = $this->getFormErrors();

        $errors->add($field, $message);

        return $this;
    }

    /**
     * Return whether the form has errors or not.
     *
     * @return bool
     */
    public function hasFormErrors()
    {
        $errors = $this->form->getErrors();

        return !$errors->isEmpty();
    }

    /**
     * Return whether the field has an error or not.
     *
     * @param $fieldName
     * @return bool
     */
    public function hasFormError($fieldName)
    {
        return $this->form->hasError($fieldName);
    }

    /**
     * Get the form actions.
     *
     * @return ActionCollection
     */
    public function getFormActions()
    {
        return $this->form->getActions();
    }

    /**
     * Get the active form action.
     *
     * @return null|ActionInterface
     */
    public function getActiveFormAction()
    {
        if (!$actions = $this->form->getActions()) {
            return null;
        }

        if (!$active = $actions->active()) {
            return null;
        }

        return $active;
    }

    /**
     * Add a form button.
     *
     * @param  ButtonInterface $button
     * @return $this
     */
    public function addFormButton(ButtonInterface $button)
    {
        $this->form->addButton($button);

        return $this;
    }

    /**
     * Add a form section.
     *
     * @param        $slug
     * @param  array $section
     * @return $this
     */
    public function addFormSection($slug, array $section)
    {
        $this->form->addSection($slug, $section);

        return $this;
    }

    /**
     * Set the form entry.
     *
     * @param $entry
     * @return $this
     */
    public function setFormEntry($entry)
    {
        $this->form->setEntry($entry);

        return $this;
    }

    /**
     * Set an attribute on the form's entry.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setFormEntryAttribute($key, $value)
    {
        $this
            ->getFormEntry()
            ->setAttribute($key, $value);

        return $this;
    }

    /**
     * Get an attribute from the form's entry.
     *
     * @param      $key
     * @param null $default
     * @return mixed|null
     */
    public function getFormEntryAttribute($key, $default = null)
    {
        return $this
            ->getFormEntry()
            ->getAttribute($key, $default);
    }

    /**
     * Get a request value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function getRequestValue($key, $default = null)
    {
        return array_get($_REQUEST, $this->getOption('prefix') . $key, $default);
    }

    /**
     * Get a post value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function getPostValue($key, $default = null)
    {
        return array_get($_POST, $this->getOption('prefix') . $key, $default);
    }

    /**
     * Return a post key flag.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function hasPostedInput($key)
    {
        return isset($_POST[$this->getOption('prefix') . $key]);
    }

    /**
     * Return whether any post data exists.
     *
     * @return bool
     */
    public function hasPostData()
    {
        /* @var FieldType $field */
        foreach ($this->getFormFields() as $field) {
            if ($field->hasPostedInput()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return whether any post data exists.
     *
     * @return array
     */
    public function getPostData()
    {
        $fields = $this->getFormFieldSlugs($this->getOption('prefix'));

        return array_intersect_key($_POST, array_flip($fields));
    }

    /**
     * Set the save flag.
     *
     * @param  bool $save
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

    /**
     * Set the read only flag.
     *
     * @param $readOnly
     * @return $this
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    /**
     * Return the read only flag.
     *
     * @return bool
     */
    public function isReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * Set the lock instance.
     *
     * @param LockInterface $lock
     * @return $this
     */
    public function setLock(LockInterface $lock)
    {
        $this->lock = $lock;

        return $this;
    }

    /**
     * Get the lock instance.
     *
     * @return LockInterface
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * Set the locked flag.
     *
     * @param $locked
     * @return $this
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Return if the form is locked.
     *
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * Set the parent.
     *
     * @param FormBuilder $parent
     * @return $this
     */
    public function setParentBuilder(FormBuilder $parent)
    {
        $this->parentBuilder = $parent;

        return $this;
    }

    /**
     * Get the parent.
     *
     * @return FormBuilder|null
     */
    public function getParentBuilder()
    {
        return $this->parentBuilder;
    }

    /**
     * Return if has parent.
     *
     * @return bool
     */
    public function isChildForm()
    {
        return (bool)$this->parentBuilder;
    }

}
