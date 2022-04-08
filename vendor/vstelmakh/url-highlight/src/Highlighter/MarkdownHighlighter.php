<?php

namespace VStelmakh\UrlHighlight\Highlighter;

use VStelmakh\UrlHighlight\Matcher\UrlMatch;
use VStelmakh\UrlHighlight\Util\LinkHelper;

class MarkdownHighlighter implements HighlighterInterface
{
    /**
     * @var string
     */
    private $defaultScheme;

    /**
     * @param string $defaultScheme Used to build link for urls matched without scheme
     */
    public function __construct(string $defaultScheme = 'http')
    {
        $this->defaultScheme = $defaultScheme;
    }

    /**
     * Return markdown link highlight
     * Example: [http://example.com](http://example.com)
     *
     * @param UrlMatch $match
     * @return string
     */
    public function getHighlight(UrlMatch $match): string
    {
        $link = LinkHelper::getLink($match, $this->defaultScheme);
        $fullMatchSafeBrackets = str_replace(['[', ']'], ['\\[', '\\]'], $match->getFullMatch());
        $linkSafeBrackets = str_replace(['(', ')'], ['%28', '%29'], $link);
        return sprintf('[%s](%s)', $fullMatchSafeBrackets, $linkSafeBrackets);
    }

    /**
     * Filter highlight in markdown links
     *
     * @param string $string
     * @return string
     */
    public function filterOverhighlight(string $string): string
    {
        $string = $this->filterHighlightInText($string);
        $string = $this->filterHighlightInLink($string);
        return $string;
    }

    /**
     * Filter markdown link inside markdown link text
     * Example: [[http://example.com](http://example.com)](http://example.com)
     * Result: [http://example.com](http://example.com)
     *
     * @param string $string
     * @return string
     */
    private function filterHighlightInText(string $string): string
    {
        $regex = '/
            (
                \[               # text start
            )
            \[(.+)\]\([^\(\)]+\) # markdown link (capture text)
            (
                \]\(.+\)         # text end with following link
            )
        /ixuU';

        return preg_replace($regex, '$1$2$3', $string) ?? $string;
    }

    /**
     * Filter markdown link inside markdown link
     * Example: [http://example.com]([http://example.com](http://example.com))
     * Result: [http://example.com](http://example.com)
     *
     * @param string $string
     * @return string
     */
    private function filterHighlightInLink(string $string): string
    {
        $regex = '/
            (
                \]\(             # link start, prefixed with text
            )
            \[.+\]\(([^\(\)]+)\) # markdown link (capture link)
            (
                \)               # link end
            )
        /ixuU';

        return preg_replace($regex, '$1$2$3', $string) ?? $string;
    }
}
