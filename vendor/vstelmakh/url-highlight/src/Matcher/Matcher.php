<?php

namespace VStelmakh\UrlHighlight\Matcher;

use VStelmakh\UrlHighlight\Filter\BalancedFilter;
use VStelmakh\UrlHighlight\Validator\ValidatorInterface;

/**
 * @internal
 */
class Matcher implements MatcherInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var BalancedFilter
     */
    private $balancedFilter;

    /**
     * @internal
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->balancedFilter = new BalancedFilter();
    }

    /**
     * Match string by url regex
     *
     * @param string $string
     * @return UrlMatch|null
     */
    public function match(string $string): ?UrlMatch
    {
        $urlRegex = $this->getUrlRegex(true);
        preg_match($urlRegex, $string, $rawMatch, PREG_OFFSET_CAPTURE);
        if (empty($rawMatch)) {
            return null;
        }
        $match = $this->createMatch($rawMatch);
        return $this->validator->isValidMatch($match) ? $match : null;
    }

    /**
     * Get all valid url regex matches from string
     *
     * @param string $string
     * @return array&UrlMatch[]
     */
    public function matchAll(string $string): array
    {
        $result = [];
        $urlRegex = $this->getUrlRegex(false);
        preg_match_all($urlRegex, $string, $rawMatches, PREG_SET_ORDER + PREG_OFFSET_CAPTURE);
        foreach ($rawMatches as $rawMatch) {
            $match = $this->createMatch($rawMatch);
            if ($this->validator->isValidMatch($match)) {
                $result[] = $match;
            }
        }
        return $result;
    }

    /**
     * @param bool $strict
     * @return string
     */
    private function getUrlRegex(bool $strict): string
    {
        $prefix = $strict ? '^' : '';
        $suffix = $strict ? '$' : '';

        return '/' . $prefix . '
            (?|                                                        # scheme
                (?<scheme>[a-z][\w\-]+):\/{2}                              # scheme ending with :\/\/
                |                                                          # or
                (?<scheme>mailto):                                         # mailto
            )?
            (?:                                                        # userinfo
                (?:
                    (?<=\/{2})                                             # prefixed with \/\/
                    |                                                      # or
                    (?=[^\p{Sm}\p{Sc}\p{Sk}\p{P}])                         # start with not: mathematical, currency, modifier symbol, punctuation
                )
                (?<userinfo>[^\s<>@\/]+)                                   # not: whitespace, < > @ \/
                @                                                          # at
            )?
            (?=[^\p{Z}\p{Sm}\p{Sc}\p{Sk}\p{C}\p{P}])                   # followed by valid host char
            (?|                                                        # host
                (?<host>                                                   # host prefixed by scheme or userinfo (less strict)
                    (?<=\/{2}|@)                                               # prefixed with \/\/ or @
                    (?=[^\-])                                                  # label start, not: -
                    (?:[^\p{Z}\p{Sm}\p{Sc}\p{Sk}\p{C}\p{P}]|-){1,63}           # label not: whitespace, mathematical, currency, modifier symbol, control point, punctuation | except -
                    (?<=[^\-])                                                 # label end, not: -
                    (?:                                                        # more label parts
                        \.
                        (?=[^\-])                                                  # label start, not: -
                        (?<tld>(?:[^\p{Z}\p{Sm}\p{Sc}\p{Sk}\p{C}\p{P}]|-){1,63})   # label not: whitespace, mathematical, currency, modifier symbol, control point, punctuation | except -
                        (?<=[^\-])                                                 # label end, not: -
                    )*
                )
                |                                                          # or
                (?<host>                                                   # host with tld (no scheme or userinfo)
                    (?=[^\-])                                                  # label start, not: -
                    (?:[^\p{Z}\p{Sm}\p{Sc}\p{Sk}\p{C}\p{P}]|-){1,63}           # label not: whitespace, mathematical, currency, modifier symbol, control point, punctuation | except -
                    (?<=[^\-])                                                 # label end, not: -
                    (?:                                                        # more label parts
                        \.
                        (?=[^\-])                                                  # label start, not: -
                        (?:[^\p{Z}\p{Sm}\p{Sc}\p{Sk}\p{C}\p{P}]|-){1,63}           # label not: whitespace, mathematical, currency, modifier symbol, control point, punctuation | except -
                        (?<=[^\-])                                                 # label end, not: -
                    )*                                                             
                    \.(?<tld>\w{2,63})                                         # tld
                )
            )
            (?:\:(?<port>\d+))?                                        # port
            (?<path>                                                   # path, query, fragment
                [\/?]                                                  # prefixed with \/ or ?
                [^\s<>]*                                               # any chars except whitespace and <>
                (?<=[^\s<>({\[`!;:\'".,?«»“”‘’])                       # end with not a space or some punctuation chars
            )?
        ' . $suffix . '/ixuJ';
    }

    /**
     * @param array|mixed[] $rawMatch
     * @return UrlMatch
     */
    private function createMatch(array $rawMatch): UrlMatch
    {
        $fullMatch = $this->balancedFilter->filter($rawMatch[0][0]);
        $path = $this->balancedFilter->filter($rawMatch['path'][0] ?? '');

        return new UrlMatch(
            $fullMatch,
            $rawMatch[0][1],
            $fullMatch,
            $rawMatch['scheme'][0] ?? null,
            $rawMatch['userinfo'][0] ?? null,
            $rawMatch['host'][0] ?? null,
            $rawMatch['tld'][0] ?? null,
            $rawMatch['port'][0] ?? null,
            $path
        );
    }
}
