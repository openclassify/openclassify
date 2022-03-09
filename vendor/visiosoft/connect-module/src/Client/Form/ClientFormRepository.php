<?php namespace Visiosoft\ConnectModule\Client\Form;

use Visiosoft\ConnectModule\Client\ClientModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

/**
 * Class ClientFormRepository
 *

 */
class ClientFormRepository implements FormRepositoryInterface
{

    /**
     * The auth service.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The form model.
     *
     * @var Client
     */
    protected $model;

    /**
     * The client repository.
     *
     * @var ClientRepository
     */
    protected $repository;

    /**
     * Create a new EloquentFormRepositoryInterface instance.
     *
     * @param Guard            $auth
     * @param ClientModel           $model
     * @param ClientRepository $repository
     */
    public function __construct(Guard $auth, ClientModel $model, ClientRepository $repository)
    {
        $this->auth       = $auth;
        $this->model      = $model;
        $this->repository = $repository;
    }

    /**
     * Find an entry.
     *
     * @param $id
     * @return Client
     */
    public function findOrNew($id)
    {
        return $this->model->findOrNew($id);
    }

    /**
     * Save the form.
     *
     * @param FormBuilder $builder
     */
    public function save(FormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        $data = $this->prepareValueData($builder);

        if ($entry->getKey()) {
            $entry->update($data);
        } else {
            $entry = $this->model->forceFill([
                'user_id' => array_value($data, 'user_id', $this->auth->id()),
                'name' =>  array_value($data, 'name'),
                'secret' => Str::random(40),
                'redirect' => array_value($data, 'redirect'),
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
            ]);

            $entry->save();
        }

        $builder->setFormEntry($entry);
    }

    /**
     * Prepare the value data for update / create.
     *
     * @param  FormBuilder $builder
     * @return array
     */
    protected function prepareValueData(FormBuilder $builder)
    {
        $form = $builder->getForm();

        $entry  = $form->getEntry();
        $fields = $form->getFields();

        $disabled = $fields->disabled();

        /*
         * Set initial data from the
         * entry, minus undesired data.
         */
        $data = array_diff_key(
            $entry->getAttributes(),
            array_merge(
                ['id', 'created_at', 'created_by', 'updated_at', 'updated_by'],
                array_flip($disabled->fieldSlugs())
            )
        );

        /**
         * Save default translation input.
         *
         * @var FieldType $field
         */
        foreach ($fields as $field) {
            array_set($data, str_replace('__', '.', $field->getField()), $form->getValue($field->getInputName()));
        }
        return $data;
    }
}
