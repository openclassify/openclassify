<?php namespace Anomaly\PreferencesModule\Preference\Form;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Container\Container;

/**
 * Class PreferenceFormRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PreferenceFormRepository implements FormRepositoryInterface
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The application container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The preferences repository.
     *
     * @var PreferenceRepositoryInterface
     */
    protected $preferences;

    /**
     * Create a new PreferenceFormRepositoryInterface instance.
     *
     * @param Repository                    $config
     * @param Container                     $container
     * @param PreferenceRepositoryInterface $preferences
     */
    public function __construct(Repository $config, Container $container, PreferenceRepositoryInterface $preferences)
    {
        $this->config      = $config;
        $this->preferences = $preferences;
        $this->container   = $container;
    }

    /**
     * Find an entry or return a new one.
     *
     * @param $id
     * @return string
     */
    public function findOrNew($id)
    {
        return $id;
    }

    /**
     * Save the form.
     *
     * @param  FormBuilder $builder
     * @return bool|mixed
     */
    public function save(FormBuilder $builder)
    {
        $form = $builder->getForm();

        $namespace = $form->getEntry() . '::';

        /* @var FieldType $field */
        foreach ($form->getEnabledFields() as $field) {

            $key   = $namespace . $field->getField();
            $value = $form->getValue($field->getInputName());

            $this->preferences->set($key, $value);
        }
    }
}
