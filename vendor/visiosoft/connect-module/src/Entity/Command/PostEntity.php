<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PostEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class PostEntity
{

    use DispatchesJobs;

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new PostEntity instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->builder->fire('posting', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('entity_posting');

        $this->dispatch(new LoadEntityValues($this->builder));
        $this->dispatch(new ValidateEntity($this->builder));
        $this->dispatch(new RemoveSkippedFields($this->builder));
        $this->dispatch(new HandleEntity($this->builder));
        $this->dispatch(new SetSuccessMessage($this->builder));
        $this->dispatch(new SetActionResponse($this->builder));

        if ($this->builder->isAjax()) {
            $this->dispatch(new SetJsonResponse($this->builder));
        }

        $this->builder->fire('posted', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('entity_posted');
    }
}
