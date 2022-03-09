<?php

namespace VStelmakh\UrlHighlight\Matcher;

/**
 * @internal
 */
interface MatcherInterface
{
    /**
     * Match string by url regex
     *
     * @param string $string
     * @return UrlMatch|null
     */
    public function match(string $string): ?UrlMatch;

    /**
     * Get all valid url regex matches from string
     *
     * @param string $string
     * @return array&UrlMatch[]
     */
    public function matchAll(string $string): array;
}
