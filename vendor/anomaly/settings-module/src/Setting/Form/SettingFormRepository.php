<?php namespace Anomaly\SettingsModule\Setting\Form;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\SettingsWereSaved;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SettingFormRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingFormRepository implements FormRepositoryInterface
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new SettingFormRepositoryInterface instance.
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
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
     * @param  FormBuilder|SettingFormBuilder $builder
     */
    public function save(FormBuilder $builder)
    {
        $form = $builder->getForm();

        $namespace = $form->getEntry() . '::';

        /* @var FieldType $field */
        foreach ($form->getEnabledFields() as $field) {

            $key   = $namespace . $field->getField();
            $value = $form->getValue($field->getInputName());

            $this->settings->set($key, $value);
        }

        event(new SettingsWereSaved($builder));
    }
}
