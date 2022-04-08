<?php

namespace VStelmakh\UrlHighlight\Encoder;

/**
 * Could be used when input string expected to be html special chars encoded (&, ", ', <, >)
 */
class HtmlSpecialcharsEncoder extends HtmlEntitiesEncoder
{
    private const HTML_SPECIAL_CHARS = ['&', '"', '\'', '<', '>'];

    /**
     * If html special char, return regex to match: char or html entity or numeric character reference
     *     else return provided char regex safe
     *
     * @param string $char
     * @param string $delimiter
     * @return string
     */
    public function getEncodedCharRegex(string $char, string $delimiter = '/'): string
    {
        return \in_array($char, self::HTML_SPECIAL_CHARS, true)
            ? parent::getEncodedCharRegex($char)
            : preg_quote($char, $delimiter);
    }

    /**
     * Return html special chars
     *
     * @return string[]|null
     */
    public function getSupportedChars(): ?array
    {
        return self::HTML_SPECIAL_CHARS;
    }
}
