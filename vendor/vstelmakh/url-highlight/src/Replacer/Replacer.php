<?php

namespace VStelmakh\UrlHighlight\Replacer;

use VStelmakh\UrlHighlight\Matcher\MatcherInterface;

/**
 * @internal
 */
class Replacer implements ReplacerInterface
{
    /**
     * @var MatcherInterface
     */
    private $matcher;

    /**
     * @internal
     * @param MatcherInterface $matcher
     */
    public function __construct(MatcherInterface $matcher)
    {
        $this->matcher = $matcher;
    }

    /**
     * @inheritdoc
     */
    public function replaceCallback(string $string, callable $callback): string
    {
        $offset = 0;

        $matches = $this->matcher->matchAll($string);
        foreach ($matches as $match) {
            $replacement = $callback($match, $match->getFullMatch());
            $position = $match->getByteOffset() + $offset;
            $length = strlen($match->getFullMatch());
            $string = substr_replace($string, $replacement, $position, $length);
            $offset += strlen($replacement) - $length;
        }

        return $string;
    }
}
