<?php namespace Anomaly\PostsModule\Type;

use Anomaly\PostsModule\Post\PostCollection;
use Anomaly\PostsModule\Post\PostModel;
use Anomaly\PostsModule\Type\Command\GetTypeStream;
use Anomaly\PostsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Model\Posts\PostsTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeModel extends PostsTypesEntryModel implements TypeInterface
{

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'posts',
    ];

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the meta title.
     *
     * @return string
     */
    public function getMetaTitle()
    {
        if (!$this->meta_title) {
            return $this->getName();
        }

        return $this->meta_title;
    }

    /**
     * Get the meta description.
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetTypeStream($this));
    }

    /**
     * Get the related entry stream ID.
     *
     * @return integer
     */
    public function getEntryStreamId()
    {
        $stream = $this->getEntryStream();

        return $stream->getId();
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get the theme layout.
     *
     * @return string
     */
    public function getThemeLayout()
    {
        return $this->theme_layout;
    }

    /**
     * Get related posts.
     *
     * @return PostCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Return the posts relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(PostModel::class, 'type_id');
    }
}
