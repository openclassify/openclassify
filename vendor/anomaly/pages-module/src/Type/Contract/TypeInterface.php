<?php namespace Anomaly\PagesModule\Type\Contract;

use Anomaly\PagesModule\Page\Handler\Contract\PageHandlerInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Interface TypeInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface TypeInterface extends EntryInterface
{

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId();

    /**
     * Get the related entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel();

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Get the page handler.
     *
     * @return PageHandlerInterface
     */
    public function getHandler();

    /**
     * Get the theme layout.
     *
     * @return string
     */
    public function getThemeLayout();

    /**
     * Get the related pages.
     *
     * @return PageCollection
     */
    public function getPages();

    /**
     * Return the pages relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages();
}
