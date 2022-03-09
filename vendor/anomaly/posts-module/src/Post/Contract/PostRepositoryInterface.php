<?php namespace Anomaly\PostsModule\Post\Contract;

use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\PostsModule\Post\PostCollection;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface PostRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface PostRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a post by it's slug.
     *
     * @param $post
     * @return null|PostInterface
     */
    public function findBySlug($slug);

    /**
     * Find a post by it's string ID.
     *
     * @param $id
     * @return null|PostInterface
     */
    public function findByStrId($id);

    /**
     * Find many posts by tag.
     *
     * @param                 $tag
     * @param  null           $limit
     * @return PostCollection
     */
    public function findManyByTag($tag, $limit = null);

    /**
     * Find many posts by category.
     *
     * @param  CategoryInterface $category
     * @param  null              $limit
     * @return PostCollection
     */
    public function findManyByCategory(CategoryInterface $category, $limit = null);

    /**
     * Find many posts by type.
     *
     * @param  TypeInterface  $type
     * @param  null           $limit
     * @return PostCollection
     */
    public function findManyByType(TypeInterface $type, $limit = null);

    /**
     * Find many posts by date.
     *
     * @param                 $year
     * @param                 $month
     * @param  null           $limit
     * @return PostCollection
     */
    public function findManyByDate($year, $month, $limit = null);

    /**
     * Get recent posts.
     *
     * @param  null           $limit
     * @return PostCollection
     */
    public function getRecent($limit = null);

    /**
     * Get featured posts.
     *
     * @param  null           $limit
     * @return PostCollection
     */
    public function getFeatured($limit = null);

    /**
     * Get live posts.
     *
     * @return PostCollection
     */
    public function getLive();
}
