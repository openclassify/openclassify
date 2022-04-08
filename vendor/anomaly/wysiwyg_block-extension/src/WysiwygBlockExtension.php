<?php namespace Anomaly\WysiwygBlockExtension;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\WysiwygBlockExtension\Block\BlockModel;

/**
 * Class WysiwygBlockExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class WysiwygBlockExtension extends BlockExtension
{

    /**
     * The extension category.
     *
     * @var string
     */
    protected $category = 'content';

    /**
     * This extension provides a wysiwyg
     * block for the blocks module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.blocks::block.wysiwyg';

    /**
     * The block view.
     *
     * @var string
     */
    protected $view = 'anomaly.extension.wysiwyg_block::content';

    /**
     * The block model.
     *
     * @var string
     */
    protected $model = BlockModel::class;

}
