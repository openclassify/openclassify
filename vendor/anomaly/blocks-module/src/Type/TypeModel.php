<?php namespace Anomaly\BlocksModule\Type;

use Anomaly\BlocksModule\Block\BlockCollection;
use Anomaly\BlocksModule\Block\Handler\Contract\BlockHandlerInterface;
use Anomaly\BlocksModule\Type\Command\GetStream;
use Anomaly\BlocksModule\Type\Contract\TypeInterface;
use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\Blocks\BlocksTypesEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class TypeModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeModel extends BlocksTypesEntryModel implements TypeInterface
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
        'blocks',
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
     * Get the category.
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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
     * Get content layout view.
     *
     * @return string
     */
    public function getContentLayoutView()
    {
        /* @var EditorFieldType $fieldType */
        $fieldType = $this->getFieldType('content_layout');

        return $fieldType->getViewPath();
    }

    /**
     * Get wrapper layout view.
     *
     * @return string
     */
    public function getWrapperLayoutView()
    {
        /* @var EditorFieldType $fieldType */
        $fieldType = $this->getFieldType('wrapper_layout');

        return $fieldType->getViewPath();
    }

    /**
     * Get the related blocks.
     *
     * @return BlockCollection
     */
    public function getBlocks()
    {
        return $this
            ->blocks()
            ->getResults();
    }

    /**
     * Return the blocks relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany('Anomaly\BlocksModule\Block\BlockModel', 'type_id');
    }
}
