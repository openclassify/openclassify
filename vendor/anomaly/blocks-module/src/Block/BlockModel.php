<?php

namespace Anomaly\BlocksModule\Block;

use Anomaly\BlocksModule\Block\Command\MakeBlock;
use Anomaly\BlocksModule\Block\Command\RenderBlock;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Blocks\BlocksBlocksEntryModel;

/**
 * Class BlockModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlockModel extends BlocksBlocksEntryModel implements BlockInterface
{

    /**
     * The eager loaded relations.
     *
     * @var array
     */
    protected $with = [
        'entry',
    ];

    /**
     * Cascade these relations.
     *
     * @var array
     */
    protected $cascades = [
        'entry',
    ];

    /**
     * The block data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * The configuration repository.
     *
     * @var ConfigurationRepositoryInterface
     */
    protected $configuration;

    /**
     * Create a new BlockModel instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->settings      = app(SettingRepositoryInterface::class);
        $this->configuration = app(ConfigurationRepositoryInterface::class);

        parent::__construct($attributes);
    }

    /**
     * Return the rendered block.
     *
     * @param array $payload
     * @return string
     */
    public function render(array $payload = [])
    {
        $this->make($payload);

        return $this->dispatch(new RenderBlock($this, $payload));
    }

    /**
     * Make the block content.
     *
     * @param array $payload
     * @return $this
     */
    public function make(array $payload = [])
    {
        $this->dispatch(new MakeBlock($this, $payload));

        return $this;
    }

    /**
     * Get the extension.
     *
     * @return BlockExtension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Get the extension slug.
     *
     * @return string
     */
    public function getExtensionSlug()
    {
        return $this
            ->getExtension()
            ->getSlug();
    }

    /**
     * Get the extension namespace.
     *
     * @return string
     */
    public function getExtensionNamespace()
    {
        return $this
            ->getExtension()
            ->getNamespace();
    }

    /**
     * Return the loaded extension.
     *
     * @return BlockExtension
     */
    public function extension()
    {
        return $this
            ->getExtension()
            ->setBlock($this);
    }

    /**
     * Return a setting value.
     *
     * @param      $key
     * @param null $default
     * @return FieldTypePresenter|null
     */
    public function setting($key, $default = null)
    {
        $extension = $this->getExtension();

        if ($default !== null) {
            return $this->settings->value($extension->getNamespace($key), $default);
        }

        return $this->settings->presenter($extension->getNamespace($key));
    }

    /**
     * Return a configuration value.
     *
     * @param      $key
     * @param null $default
     * @return FieldTypePresenter|null
     */
    public function configuration($key, $default = null)
    {
        $extension = $this->getExtension();

        if ($default !== null) {
            return $this->configuration->value($extension->getNamespace($key), $this->getId(), $default);
        }

        return $this->configuration->presenter($extension->getNamespace($key), $this->getId());
    }

    /**
     * Get the title.
     *
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the related entry.
     *
     * @return null|EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the related area.
     *
     * @return null|EntryInterface
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Get the related entry ID.
     *
     * @return null|int
     */
    public function getEntryId()
    {
        return $this->entry_id;
    }

    /**
     * Get the content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the content.
     *
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data.
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Return if the block has data by key.
     *
     * @param $key
     * @return bool
     */
    public function hasData($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Add some data.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function addData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }
}
