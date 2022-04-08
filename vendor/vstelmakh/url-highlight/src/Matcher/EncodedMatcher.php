<?php

namespace VStelmakh\UrlHighlight\Matcher;

use VStelmakh\UrlHighlight\Encoder\EncoderInterface;
use VStelmakh\UrlHighlight\Util\StringHelper;

/**
 * @internal
 */
class EncodedMatcher implements MatcherInterface
{
    /**
     * @var Matcher
     */
    private $matcher;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @internal
     * @param Matcher $matcher
     * @param EncoderInterface $encoder
     */
    public function __construct(Matcher $matcher, EncoderInterface $encoder)
    {
        $this->matcher = $matcher;
        $this->encoder = $encoder;
    }

    /**
     * Match string by url regex
     *
     * @param string $string
     * @return UrlMatch|null
     */
    public function match(string $string): ?UrlMatch
    {
        $decodedString = $this->encoder->decode($string);
        $match = $this->matcher->match($decodedString);
        return $match ? $this->getEncodedMatch($string, 0, $match) : null;
    }

    /**
     * Get all valid url regex matches from encoded string
     *
     * @param string $string
     * @return array&UrlMatch[]
     */
    public function matchAll(string $string): array
    {
        $encodedMatches = [];
        $nextMatchOffset = 0;

        $decodedString = $this->encoder->decode($string);
        $matches = $this->matcher->matchAll($decodedString);

        foreach ($matches as $match) {
            $regex = sprintf('/%s/iu', $this->getEncodedMatchRegex($match));
            preg_match($regex, $string, $encodedRawMatch, PREG_OFFSET_CAPTURE, $nextMatchOffset);

            // @codeCoverageIgnoreStart
            if (empty($encodedRawMatch)) {
                // Encoded match not found. Could happen because of encoder was able to decode,
                //   but not building proper regex to look for encoded url.
                // TODO: throw exception?
                continue;
            }
            // @codeCoverageIgnoreEnd

            $encodedFullMatch = $encodedRawMatch[0][0];
            $encodedByteOffset = $encodedRawMatch[0][1];
            $nextMatchOffset = $encodedByteOffset + strlen($encodedFullMatch);
            $encodedMatches[] = $this->getEncodedMatch($encodedFullMatch, $encodedByteOffset, $match);
        }

        return $encodedMatches;
    }

    /**
     * Replace html special chars with char variations regex
     *
     * @param UrlMatch $match
     * @return string
     */
    private function getEncodedMatchRegex(UrlMatch $match): string
    {
        $supportedChars = $this->encoder->getSupportedChars();
        return !empty($supportedChars)
            ? $this->getUrlRegexBySupportedChars($match, $supportedChars)
            : $this->getUrlRegexByAllChars($match);
    }

    /**
     * @param UrlMatch $match
     * @param array&string[] $supportedChars
     * @return string
     */
    private function getUrlRegexBySupportedChars(UrlMatch $match, array $supportedChars): string
    {
        $replace = [];
        foreach ($supportedChars as $char) {
            $replace[] = $this->getRegexCharGroup($char);
        }

        $fullMatchRegexSafe = preg_quote($match->getUrl(), '/');
        return str_replace($supportedChars, $replace, $fullMatchRegexSafe);
    }

    /**
     * @param UrlMatch $match
     * @return string
     */
    private function getUrlRegexByAllChars(UrlMatch $match): string
    {
        $fullMatchRegex = '';

        $fullMatchChars = StringHelper::getChars($match->getUrl());
        foreach ($fullMatchChars as $char) {
            $fullMatchRegex .= $this->getRegexCharGroup($char);
        }

        return $fullMatchRegex;
    }

    /**
     * @param string $char
     * @return string
     */
    private function getRegexCharGroup(string $char): string
    {
        return '(?:' . $this->encoder->getEncodedCharRegex($char, '/') . ')';
    }

    /**
     * @param string $fullMatch
     * @param int $byteOffset
     * @param UrlMatch $match
     * @return UrlMatch
     */
    private function getEncodedMatch(string $fullMatch, int $byteOffset, UrlMatch $match): UrlMatch
    {
        return new UrlMatch(
            $fullMatch,
            $byteOffset,
            $match->getUrl(),
            $match->getScheme(),
            $match->getUserinfo(),
            $match->getHost(),
            $match->getTld(),
            (string) $match->getPort(),
            $match->getPath()
        );
    }
}
