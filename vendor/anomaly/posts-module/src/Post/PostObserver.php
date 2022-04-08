<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Category\Command\PurgeCategoryCache;
use Anomaly\PostsModule\Post\Command\PurgeIndexCache;
use Anomaly\PostsModule\Post\Command\PurgePostCache;
use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class PostObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostObserver extends EntryObserver
{

    /**
     * Fired just before saving the entry.
     *
     * @param EntryInterface|PostInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        $entry->setAttribute('str_id', str_random());

        parent::creating($entry);
    }

    /**
     * Fired just before saving the entry.
     *
     * @param EntryInterface|PostInterface $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new PurgePostCache($entry));

        parent::saving($entry);
    }

    /**
     * Fired just after saving the entry.
     *
     * @param EntryInterface|PostInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new PurgePostCache($entry));
        $this->dispatch(new PurgeIndexCache($entry));

        if ($category = $entry->getCategory()) {
            $this->dispatch(new PurgeCategoryCache($category));
        }

        parent::saved($entry);
    }
}
