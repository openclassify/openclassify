<?php namespace Anomaly\HtmlBlockExtension;

use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\HtmlBlockExtension\Block\BlockModel;

/**
 * Class HtmlBlockExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HtmlBlockExtension extends BlockExtension
{

    /**
     * The extension category.
     *
     * @var string
     */
    protected $category = 'content';

    /**
     * This extension provides an HTML
     * block for the blocks module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.blocks::block.html';

    /**
     * The block view.
     *
     * @var string
     */
    protected $view = 'anomaly.extension.html_block::content';

    /**
     * The block model.
     *
     * @var string
     */
    protected $model = BlockModel::class;

}
