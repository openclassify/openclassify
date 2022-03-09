<?php

namespace VStelmakh\UrlHighlight\Validator;

use VStelmakh\UrlHighlight\Domains;
use VStelmakh\UrlHighlight\Matcher\UrlMatch;
use VStelmakh\UrlHighlight\Util\CaseInsensitiveSet;

class Validator implements ValidatorInterface
{
    /**
     * @var bool
     */
    private $matchByTLD;

    /**
     * @var CaseInsensitiveSet
     */
    private $schemeBlacklist;

    /**
     * @var CaseInsensitiveSet
     */
    private $schemeWhitelist;

    /**
     * @var bool
     */
    private $matchEmails;

    /**
     * @param bool $matchByTLD
     * @param array&string[] $schemeBlacklist
     * @param array&string[] $schemeWhitelist
     * @param bool $matchEmails
     */
    public function __construct(
        bool $matchByTLD = true,
        array $schemeBlacklist = [],
        array $schemeWhitelist = [],
        bool $matchEmails = true
    ) {
        $this->matchByTLD = $matchByTLD;
        $this->schemeBlacklist = new CaseInsensitiveSet($schemeBlacklist);
        $this->schemeWhitelist = new CaseInsensitiveSet($schemeWhitelist);
        $this->matchEmails = $matchEmails;
    }

    /**
     * Verify if url match (scheme or host) fit config requirements
     *
     * @param UrlMatch $match
     * @return bool
     */
    public function isValidMatch(UrlMatch $match): bool
    {
        $scheme = $match->getScheme();
        if (!empty($scheme) && $scheme !== 'mailto') {
            return $this->isAllowedScheme($scheme);
        }

        if (!$this->matchEmails && $this->isEmail($match)) {
            return false;
        }

        $tld = $match->getTld();
        if (!empty($tld) && $this->matchByTLD) {
            return $this->isValidTopLevelDomain($tld);
        }

        return false;
    }

    /**
     * @param UrlMatch $match
     * @return bool
     */
    private function isEmail(UrlMatch $match): bool
    {
        $scheme = $match->getScheme();
        $userinfo = $match->getUserinfo();
        return (empty($scheme) && !empty($userinfo)) || $scheme === 'mailto';
    }

    /**
     * @param string $scheme
     * @return bool
     */
    private function isAllowedScheme(string $scheme): bool
    {
        $isAllowedByBlacklist = !$this->schemeBlacklist->contains($scheme);
        $isAllowedByWhitelist = $this->schemeWhitelist->isEmpty() || $this->schemeWhitelist->contains($scheme);
        return $isAllowedByBlacklist && $isAllowedByWhitelist;
    }

    /**
     * @param string $topLevelDomain
     * @return bool
     */
    private function isValidTopLevelDomain(string $topLevelDomain): bool
    {
        $topLevelDomain = \mb_strtolower($topLevelDomain);
        return isset(Domains::TOP_LEVEL_DOMAINS[$topLevelDomain]);
    }
}
