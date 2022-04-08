<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Ui\Entity\Command\RepopulateFields;
use Anomaly\Streams\Platform\Ui\Entity\Command\SetErrorMessages;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Validation\Validator;

/**
 * Class EntityValidator
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityValidator
{

    use DispatchesJobs;

    /**
     * The entity rules compiler.
     *
     * @var EntityRules
     */
    protected $rules;

    /**
     * The entity input utility.
     *
     * @var EntityInput
     */
    protected $input;

    /**
     * The extender utility.
     *
     * @var EntityExtender
     */
    protected $extender;

    /**
     * The messages utility.
     *
     * @var EntityMessages
     */
    protected $messages;

    /**
     * The attributes builder.
     *
     * @var EntityAttributes
     */
    protected $attributes;

    /**
     * Create a new EntityValidator instance.
     *
     * @param EntityRules      $rules
     * @param EntityInput      $input
     * @param EntityExtender   $extender
     * @param EntityMessages   $messages
     * @param EntityAttributes $attributes
     */
    public function __construct(
        EntityRules $rules,
        EntityInput $input,
        EntityExtender $extender,
        EntityMessages $messages,
        EntityAttributes $attributes
    ) {
        $this->rules      = $rules;
        $this->input      = $input;
        $this->extender   = $extender;
        $this->messages   = $messages;
        $this->attributes = $attributes;
    }

    /**
     * Validate a entity's input.
     *
     * @param EntityBuilder $builder
     */
    public function handle(EntityBuilder $builder)
    {
        $factory = app('validator');

        $this->extender->extend($factory, $builder);

        $input      = $this->input->all($builder);
        $messages   = $this->messages->make($builder);
        $attributes = $this->attributes->make($builder);
        $rules      = $this->rules->compile($builder);

        /* @var Validator $validator */
        $validator = $factory->make($input, $rules);

        $validator->setCustomMessages($messages);
        $validator->setAttributeNames($attributes);

        $this->setResponse($validator, $builder);
    }

    /**
     * Set the response based on validation.
     *
     * @param Validator     $validator
     * @param EntityBuilder $builder
     */
    protected function setResponse(Validator $validator, EntityBuilder $builder)
    {
        if (!$validator->passes()) {

            $builder
                ->setSave(false)
                ->setEntityErrors($validator->getMessageBag());

            $this->dispatch(new SetErrorMessages($builder));
        }

        $this->dispatch(new RepopulateFields($builder));
    }
}
