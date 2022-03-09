<?php namespace Anomaly\Streams\Platform\Ui\Entity\Multiple;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Entity\Entity;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\Ui\Entity\EntityCollection;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\Command\BuildEntities;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\Command\HandleErrors;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\Command\MergeFields;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\Command\PostEntities;

/**
 * Class MultipleEntityBuilder
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Support
 */
class MultipleEntityBuilder extends EntityBuilder
{

    /**
     * The entity collection.
     *
     * @var EntityCollection
     */
    protected $entities;

    /**
     * Create a new MultipleEntityBuilder instance.
     *
     * @param Entity           $entity
     * @param EntityCollection $entities
     */
    public function __construct(Entity $entity, EntityCollection $entities)
    {
        $this->entities = $entities;

        parent::__construct($entity);
    }

    /**
     * Build the entity.
     *
     * @param null $entry
     */
    public function build($entry = null)
    {
        $this->dispatch(new BuildEntities($this));
        $this->dispatch(new PostEntities($this));
        $this->dispatch(new MergeFields($this));
        $this->dispatch(new HandleErrors($this));

        parent::build($entry);
    }

    /**
     * Save the entities.
     */
    public function saveEntity()
    {
        $this->fire('saving', ['builder' => $this]);

        /* @var EntityBuilder $builder */
        foreach ($entities = $this->getEntities() as $slug => $builder) {

            $this->fire('saving_' . $slug, compact('builder', 'entities'));

            $builder->saveEntity();

            $this->fire('saved_' . $slug, compact('builder', 'entities'));
        }

        $this->fire('saved', ['builder' => $this]);
    }

    /**
     * Get the entities.
     *
     * @return EntityCollection
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * Set the entities.
     *
     * @param $entities
     * @return $this
     */
    public function setEntities(EntityCollection $entities)
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * Add a entity.
     *
     * @param               $key
     * @param EntityBuilder $builder
     * @return $this
     */
    public function addEntity($key, EntityBuilder $builder)
    {
        $this->entities->put(
            $key,
            $builder
                ->setSave(false)
                ->setOption('prefix', $key . '_')
        );

        return $this;
    }

    /**
     * Get a child entity.
     *
     * @param $key
     * @return EntityBuilder
     */
    public function getChildEntity($key)
    {
        return $this->entities->get($key);
    }

    /**
     * Get the stream of a child entity.
     *
     * @param $key
     * @return StreamInterface|null
     */
    public function getChildEntityStream($key)
    {
        $builder = $this->getChildEntity($key);

        return $builder->getEntityStream();
    }

    /**
     * Get the entry of a child entity.
     *
     * @param $key
     * @return EloquentModel|EntryInterface|FieldInterface|AssignmentInterface|null
     */
    public function getChildEntityEntry($key)
    {
        $builder = $this->getChildEntity($key);

        return $builder->getEntityEntry();
    }

    /**
     * Get the entry ID of a child entity.
     *
     * @param $key
     * @return int|null
     */
    public function getChildEntityEntryId($key)
    {
        $builder = $this->getChildEntity($key);

        return $builder->getEntityEntryId();
    }
}
