<?php namespace Anomaly\Streams\Platform\View\Support;

use Twig_Token;
use Twig_TokenParser;

/**
 * Class CompressHtmlTokenParser
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
class CompressHtmlTokenParser extends Twig_TokenParser
{

    /**
     * Parse the token.
     *
     * @param Twig_Token $token
     * @return CompressHtmlNode
     */
    public function parse(Twig_Token $token)
    {
        $line_number = $token->getLine();

        $stream = $this->parser->getStream();

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $body = $this->parser->subparse([$this, 'decideHtmlCompressEnd'], true);

        $stream->expect(Twig_Token::BLOCK_END_TYPE);

        $nodes = ['content' => $body];

        return new CompressHtmlNode($nodes, [], $line_number, $this->getTag());
    }

    /**
     * Get the tag.
     *
     * @return string
     */
    public function getTag()
    {
        return 'htmlcompress';
    }

    /**
     * Get the closing tag decision.
     *
     * @param Twig_Token $token
     * @return bool
     */
    public function decideHtmlCompressEnd(Twig_Token $token)
    {
        return $token->test('endhtmlcompress');
    }
}
