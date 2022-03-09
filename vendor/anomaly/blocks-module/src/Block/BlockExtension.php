<?php namespace Anomaly\BlocksModule\Block;

use Anomaly\BlocksModule\Block\Command\AddConfigurationForm;
use Anomaly\BlocksModule\Block\Command\AddStreamForm;
use Anomaly\BlocksModule\Block\Command\ExtendFormSections;
use Anomaly\BlocksModule\Block\Contract\BlockInterface;
use Anomaly\BlocksModule\Block\Form\BlockInstanceFormBuilder;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class BlockExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlockExtension extends Extension
{

    /**
     * The block instance.
     *
     * @var null|BlockInterface
     */
    protected $block;

    /**
     * The block model.
     *
     * @var null|string
     */
    protected $model = null;

    /**
     * The block category.
     *
     * @var null|string
     */
    protected $category = null;

    /**
     * The block form builder.
     *
     * @var string
     */
    protected $form = FormBuilder::class;

    /**
     * The block view.
     *
     * @var null|string
     */
    protected $view = 'anomaly.module.blocks::blocks/content';

    /**
     * The block wrapper.
     *
     * @var null|string
     */
    protected $wrapper = 'anomaly.module.blocks::blocks/wrapper';

    /**
     * Extend the form builder.
     *
     * @param BlockInstanceFormBuilder $builder
     */
    public function extend(BlockInstanceFormBuilder $builder)
    {
        $this->dispatch(new AddStreamForm($builder, $this));
        $this->dispatch(new AddConfigurationForm($builder, $this));

        $this->dispatch(new ExtendFormSections($builder, $this));
    }

    /**
     * Return the block's entry stream.
     *
     * @return null|StreamInterface
     */
    public function stream()
    {
        if (!$model = $this->getModel()) {
            return null;
        }

        /* @var EntryInterface $model */
        $model = app($model);

        return $model->getStream();
    }

    /**
     * Get the block.
     *
     * @return null|BlockInterface
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Get the block's entry ID.
     *
     * @return int|null
     */
    public function getBlockEntryId()
    {
        if (!$block = $this->getBlock()) {
            return null;
        }

        return $block->getEntryId();
    }

    /**
     * Set the block.
     *
     * @param BlockInterface $block
     * @return $this
     */
    public function setBlock(BlockInterface $block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Unset the block.
     *
     * @return $this
     */
    public function unsetBlock()
    {
        $this->block = null;

        return $this;
    }

    /**
     * Get the model.
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the model.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the form.
     *
     * @return null|string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Set the form.
     *
     * @param $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get the view.
     *
     * @return null|string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the wrapper.
     *
     * @return null|string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Set the wrapper.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get the category.
     *
     * @return null|string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the category.
     *
     * @param $category
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

}
