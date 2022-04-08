<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\Posts\PostsDefaultPostsEntryModel;

/**
 * Class PostSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostSeeder extends Seeder
{

    /**
     * The post repository.
     *
     * @var PostRepositoryInterface
     */
    protected $posts;

    /**
     * The type repository.
     *
     * @var TypeRepositoryInterface
     */
    protected $types;

    /**
     * The category repository.
     *
     * @var CategoryRepositoryInterface
     */
    protected $categories;

    /**
     * Create a new PostSeeder instance.
     *
     * @param PostRepositoryInterface     $posts
     * @param TypeRepositoryInterface     $types
     * @param CategoryRepositoryInterface $categories
     */
    public function __construct(
        PostRepositoryInterface $posts,
        TypeRepositoryInterface $types,
        CategoryRepositoryInterface $categories
    ) {
        $this->posts      = $posts;
        $this->types      = $types;
        $this->categories = $categories;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->posts->truncate();

        $repository = new EntryRepository();

        $repository->setModel(new PostsDefaultPostsEntryModel());

        $repository->truncate();

        $type     = $this->types->findBySlug('default');
        $category = $this->categories->findBySlug('news');

        $welcome = (new PostsDefaultPostsEntryModel())->create(
            [
                'en' => [
                    'content' => '<p>Welcome to PyroCMS!</p>',
                ],
            ]
        );

        $this->posts->create(
            [
                'en'         => [
                    'title'   => 'Welcome to PyroCMS!',
                    'summary' => 'This is an example post to demonstrate the posts module.',
                ],
                'slug'       => 'welcome-to-pyrocms',
                'publish_at' => time(),
                'enabled'    => true,
                'type'       => $type,
                'entry'      => $welcome,
                'category'   => $category,
                'author'     => 1,
            ]
        );
    }
}
