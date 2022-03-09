<?php

namespace VStelmakh\UrlHighlight\Encoder;

/**
 * Use this interface to create custom encoders
 */
interface EncoderInterface
{
    /**
     * Decode provided string using specified algorithm
     *
     * @param string $string
     * @return string
     */
    public function decode(string $string): string;

    /**
     * Return regex to match provided char in encoded string
     *
     * @param string $char
     * @param string $delimiter
     * @return string
     */
    public function getEncodedCharRegex(string $char, string $delimiter = '/'): string;

    /**
     * Return array of specific chars used in encoder
     *
     * @return string[]|null
     */
    public function getSupportedChars(): ?array;
}
