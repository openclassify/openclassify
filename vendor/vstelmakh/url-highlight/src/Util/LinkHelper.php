<?php

namespace VStelmakh\UrlHighlight\Util;

use VStelmakh\UrlHighlight\Matcher\UrlMatch;

class LinkHelper
{
    /**
     * Return match link with scheme depends on context
     *
     * @param UrlMatch $match
     * @param string $defaultScheme
     * @return string
     */
    public static function getLink(UrlMatch $match, string $defaultScheme): string
    {
        $scheme = '';

        if (empty($match->getScheme())) {
            $isEmail = !empty($match->getUserinfo());
            $scheme = $isEmail ? 'mailto:' : $defaultScheme . '://';
        }

        return $scheme . $match->getUrl();
    }
}
