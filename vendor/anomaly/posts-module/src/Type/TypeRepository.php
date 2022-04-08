<?php namespace Anomaly\PostsModule\Type;

use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PostsModule\Type\Command\DeleteTypeStream;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class TypeRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeRepository extends EntryRepository implements TypeRepositoryInterface
{

    /**
     * The type model.
     *
     * @var TypeModel
     */
    protected $model;

    /**
     * Create a new TypeRepository instance.
     *
     * @param TypeModel $model
     */
    public function __construct(TypeModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a category by it's slug.
     *
     * @param $slug
     * @return null|TypeInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Truncate the entries.
     *
     * @return $this
     */
    public function truncate()
    {
        parent::truncate();

        foreach ($this->model->all() as $entry)
        {
            $this->dispatch(new DeleteTypeStream($entry));
        }

        return $this;
    }
}
