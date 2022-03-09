<?php

namespace VStelmakh\UrlHighlight\Filter;

/**
 * @internal
 */
class BalancedFilter implements FilterInterface
{
    /*
     * Map of openChar => closeChar
     */
    private const BALANCED_CHARS = [
        '(' => ')',
        '{' => '}',
        '[' => ']',
    ];

    /**
     * Cut the string on first non balanced bracket occurrence.
     * Keep in mind, there is no check for correct parenthesis.
     * Check only that close chars have same amount of open chars.
     *
     * @inheritdoc
     */
    public function filter(string $string): string
    {
        foreach (self::BALANCED_CHARS as $openChar => $closeChar) {
            $string = $this->filterByOpenCloseChars($string, $openChar, $closeChar);
        }
        return $string;
    }

    /**
     * Filter by one pair of open - close chars
     *
     * @param string $string
     * @param string $openChar
     * @param string $closeChar
     * @return string
     */
    private function filterByOpenCloseChars(string $string, string $openChar, string $closeChar): string
    {
        $openMatches = $this->matchCharOffset($string, $openChar);
        $closeMatches = $this->matchCharOffset($string, $closeChar);

        foreach ($closeMatches as $key => $closeMatch) {
            $closeOffset = $closeMatch[1];
            $openOffset = isset($openMatches[$key]) ? $openMatches[$key][1] : null;

            if ($openOffset === null || $openOffset > $closeOffset) {
                return substr($string, 0, $closeOffset);
            }
        }

        return $string;
    }

    /**
     * Return array of matches by provided char with offset
     *
     * @param string $string
     * @param string $char
     * @return array&array[] [0 => (string) char, 1 => (int) offset]
     */
    private function matchCharOffset(string $string, string $char): array
    {
        $regex = sprintf('/%s/u', preg_quote($char, '/'));
        preg_match_all($regex, $string, $matches, PREG_PATTERN_ORDER + PREG_OFFSET_CAPTURE);
        return $matches[0];
    }
}
