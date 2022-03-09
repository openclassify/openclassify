<?php

namespace VStelmakh\UrlHighlight\Encoder;

use VStelmakh\UrlHighlight\Util\CaseInsensitiveSet;

/**
 * Could be used when input string expected to be html entity encoded
 * Use HtmlSpecialcharsEncoder for html escaped string (less regex operations)
 */
class HtmlEntitiesEncoder implements EncoderInterface
{
    /**
     * Decode html encoded string
     *
     * @param string $string
     * @return string
     */
    public function decode(string $string): string
    {
        return html_entity_decode($string, ENT_QUOTES + ENT_HTML5);
    }

    /**
     * Return regex to match: char or html entity or numeric character reference
     *
     * @param string $char
     * @param string $delimiter
     * @return string
     */
    public function getEncodedCharRegex(string $char, string $delimiter = '/'): string
    {
        if (empty($char)) {
            return '';
        }

        $variations = new CaseInsensitiveSet([preg_quote($char, $delimiter)]);

        $encodedChar = htmlentities($char, ENT_QUOTES + ENT_HTML5);
        $variations->add(preg_quote($encodedChar, $delimiter));

        $charCodeDec = \mb_ord($char);
        $variations->add('&#0*' . $charCodeDec . ';');

        $charCodeHex = dechex($charCodeDec);
        $variations->add('&#x0*' . $charCodeHex . ';');

        return implode('|', $variations->toArray());
    }

    /**
     * Match all chars
     *
     * @return string[]|null
     */
    public function getSupportedChars(): ?array
    {
        return null;
    }
}
