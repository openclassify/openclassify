<?php namespace Anomaly\Streams\Platform\Ui\Form\Multiple;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\Component\Field\FieldCollection;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\FormCollection;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\BuildForms;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\HandleErrors;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\HandleLocks;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\MergeFields;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\PostForms;
use Anomaly\Streams\Platform\Ui\Form\Multiple\Command\VersionForms;

/**
 * Class MultipleFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MultipleFormBuilder extends FormBuilder
{

    /**
     * The form collection.
     *
     * @var FormCollection
     */
    protected $forms;

    /**
     * Create a new MultipleFormBuilder instance.
     *
     * @param Form $form
     * @param FormCollection $forms
     */
    public function __construct(Form $form, FormCollection $forms)
    {
        $this->forms = $forms;

        parent::__construct($form);
    }

    /**
     * Build the form.
     *
     * @param null $entry
     * @return $this
     */
    public function build($entry = null)
    {
        $this->fire('ready', ['builder' => $this]);

        $this->dispatchNow(new BuildForms($this));
        $this->dispatchNow(new MergeFields($this));
        $this->dispatchNow(new HandleLocks($this));

        parent::build($entry);

        $this->fire('built', ['builder' => $this]);

        return $this;
    }

    /**
     * Post the form.
     *
     * @return $this
     */
    public function post()
    {
        if (app('request')->isMethod('post')) {
            $this->dispatchNow(new PostForms($this));
            $this->dispatchNow(new HandleErrors($this));
        }

        parent::post();

        return $this;
    }

    /**
     * Validate child forms.
     *
     * @return $this
     */
    public function validate()
    {
        $this->forms->map(
            function ($form) {

                /* @var FormBuilder $form */
                $form->validate();
            }
        );

        $this->dispatchNow(new HandleErrors($this));

        return $this;
    }

    /**
     * Save the forms.
     */
    public function saveForm()
    {
        $this->fire('saving', ['builder' => $this]);

        /* @var FormBuilder $builder */
        foreach ($forms = $this->getForms() as $slug => $builder) {

            $builder->setSave($this->canSave());

            $builder->touchFormEntry();

            $this->fire('saving_' . $slug, compact('builder', 'forms'));

            $builder->saveForm();

            $this->fire('saved_' . $slug, compact('builder', 'forms'));
        }

        $this->dispatchNow(new VersionForms($this));

        $this->fire('saved', ['builder' => $this]);
    }

    /**
     * Get the forms.
     *
     * @return FormCollection
     */
    public function getForms()
    {
        return $this->forms;
    }

    /**
     * Set the forms.
     *
     * @param $forms
     * @return $this
     */
    public function setForms(FormCollection $forms)
    {
        $this->forms = $forms;

        return $this;
    }

    /**
     * Add a form.
     *
     * @param              $key
     * @param  FormBuilder $builder
     * @param null $position
     * @return MultipleFormBuilder
     */
    public function addForm($key, FormBuilder $builder, $position = null)
    {
        $builder
            ->setSave(false)
            ->setParentBuilder($this)
            ->setOption('prefix', $this->getOption('prefix') . $key . '_');

        if ($position === null) {

            $this->forms->put($key, $builder);

            return $this;
        }

        $front = array_slice($this->forms->all(), 0, $position, true);
        $back  = array_slice($this->forms->all(), $position, $this->forms->count() - $position, true);

        $forms = $this->getForms();

        $this->setForms($forms::make($front + [$key => $builder] + $back));

        return $this;
    }

    /**
     * Get a child form.
     *
     * @param $key
     * @return FormBuilder
     */
    public function getChildForm($key)
    {
        return $this->forms->get($key);
    }

    /**
     * Return if has a child form.
     *
     * @param $key
     * @return bool
     */
    public function hasChildForm($key)
    {
        return $this->forms->has($key);
    }

    /**
     * Get the stream of a child form.
     *
     * @param $key
     * @return StreamInterface|null
     */
    public function getChildFormStream($key)
    {
        $builder = $this->getChildForm($key);

        return $builder->getFormStream();
    }

    /**
     * Get the entry of a child form.
     *
     * @param $key
     * @return EloquentModel|EntryInterface|FieldInterface|AssignmentInterface|null
     */
    public function getChildFormEntry($key)
    {
        if (!$builder = $this->getChildForm($key)) {
            return null;
        }

        return $builder->getFormEntry();
    }

    /**
     * Set the entry of a child form.
     *
     * @param $key
     * @param EloquentModel|EntryInterface|FieldInterface|AssignmentInterface|null $entry
     * @return $this
     */
    public function setChildFormEntry($key, $entry)
    {
        if ($builder = $this->getChildForm($key)) {
            $builder->setEntry($entry);
            $builder->setFormEntry($entry);
        }

        return $this;
    }

    /**
     * Get the entry ID of a child form.
     *
     * @param $key
     * @return int|null
     */
    public function getChildFormEntryId($key)
    {
        $builder = $this->getChildForm($key);

        return $builder->getFormEntryId();
    }

    /**
     * Get the form field slugs.
     *
     * @param $key
     * @return FieldCollection
     */
    public function getChildFormFields($key)
    {
        $builder = $this->getChildForm($key);

        return $builder->getFormFields();
    }

    /**
     * Get the form field slugs.
     *
     * @param      $key
     * @param null $prefix
     * @return array
     */
    public function getChildFormFieldSlugs($key, $prefix = null)
    {
        $builder = $this->getChildForm($key);

        return $builder->getFormFieldSlugs($prefix);
    }

    /**
     * Get a child's entry.
     *
     * @param $key
     * @return mixed
     */
    public function getChildEntry($key)
    {
        $builder = $this->getChildForm($key);

        return $builder->getEntry();
    }

    /**
     * Get the form mode.
     *
     * @return null|string
     */
    public function getFormMode()
    {
        $form = $this->forms->first();

        return $form->getFormMode();
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {

        // Check normal behavior first.
        if ($id = parent::getContextualId()) {
            return $id;
        }

        /* @var FormBuilder $form */
        $form = $this->forms->first();

        return $form->getContextualId();
    }
}
