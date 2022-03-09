<?php

namespace VStelmakh\UrlHighlight\Replacer;

/**
 * @internal
 */
interface ReplacerInterface
{
    /**
     * Replace all valid url matches by callback
     *
     * @param string $string
     * @param callable $callback
     * @return string
     */
    public function replaceCallback(string $string, callable $callback): string;
}
