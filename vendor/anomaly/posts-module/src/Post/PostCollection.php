<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PostCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostCollection extends EntryCollection
{

    /**
     * Return only live posts.
     *
     * @return PostCollection
     */
    public function live()
    {
        return $this->filter(
            function (PostInterface $post) {
                return $post->isLive();
            }
        );
    }
}
