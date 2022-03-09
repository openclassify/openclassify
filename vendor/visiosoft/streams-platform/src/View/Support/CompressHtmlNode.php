<?php namespace Anomaly\Streams\Platform\View\Support;

use Twig_Node;

/**
 * Class CompressHtmlNode
 *
 * HUGE thanks to @zvineyard for his work on a
 * simple and fast HTML compression technique!
 *
 * @link   https://github.com/zvineyard
 * @link   http://pyrocms.com/
 * @author Zack Vineyard
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @author PyroCMS, Inc. <support@pyrocms.com>
 */
class CompressHtmlNode extends Twig_Node
{

    /**
     * Create a new CompressHtmlNode instance.
     *
     * @param array $nodes
     * @param array $attributes
     * @param int $line_number
     * @param null $tag
     */
    public function __construct(array $nodes = [], array $attributes = [], $line_number = 0, $tag = null)
    {
        parent::__construct($nodes, $attributes, $line_number, $tag);
    }

    /**
     * Compile the node.
     *
     * @param \Twig_Compiler $compiler
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("ob_start();\n")
            ->subcompile($this->getNode('content'))
            ->write(
                "echo preg_replace(['/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['>','<','\\1'],ob_get_clean());" . "\n"
            );
    }
}
