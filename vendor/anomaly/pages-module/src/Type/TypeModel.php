<?php namespace Anomaly\PagesModule\Type;

use Anomaly\PagesModule\Page\Handler\Contract\PageHandlerInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\PagesModule\Type\Command\GetStream;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Pages\PagesTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeModel extends PagesTypesEntryModel implements TypeInterface
{

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'pages',
    ];

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
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetStream($this));
    }

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId()
    {
        if (!$stream = $this->getEntryStream()) {
            return null;
        }

        return $stream->getId();
    }

    /**
     * Get the related entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModel();
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
     * Get the page handler.
     *
     * @return PageHandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
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
     * Get the related pages.
     *
     * @return PageCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Return the pages relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('Anomaly\PagesModule\Page\PageModel', 'type_id');
    }
}
