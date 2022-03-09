<?php

namespace VStelmakh\UrlHighlight\Matcher;

class UrlMatch
{
    /**
     * @var string
     */
    private $fullMatch;

    /**
     * @var int
     */
    private $byteOffset;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string|null
     */
    private $scheme;

    /**
     * @var string|null
     */
    private $userinfo;

    /**
     * @var string|null
     */
    private $host;

    /**
     * @var string|null
     */
    private $tld;

    /**
     * @var int|null
     */
    private $port;

    /**
     * @var string|null
     */
    private $path;

    /**
     * @param string $fullMatch
     * @param int $byteOffset
     * @param string $url
     * @param string|null $scheme
     * @param string|null $userinfo
     * @param string|null $host
     * @param string|null $tld
     * @param string|null $port
     * @param string|null $path
     * @internal
     */
    public function __construct(
        string $fullMatch,
        int $byteOffset,
        string $url,
        ?string $scheme,
        ?string $userinfo,
        ?string $host,
        ?string $tld,
        ?string $port,
        ?string $path
    ) {
        $this->fullMatch = $fullMatch;
        $this->byteOffset = $byteOffset;
        $this->url = $url;
        $this->scheme = $this->getStringOrNull($scheme);
        $this->userinfo = $this->getStringOrNull($userinfo);
        $this->host = $this->getStringOrNull($host);
        $this->tld = $this->getStringOrNull($tld);
        $this->port = $this->getIntOrNull($port);
        $this->path = $this->getStringOrNull($path);
    }

    /**
     * Return match found in the text. For encoded input will contain not decoded match.
     *
     * @return string
     */
    public function getFullMatch(): string
    {
        return $this->fullMatch;
    }

    /**
     * preg_* functions with flag PREG_OFFSET_CAPTURE return offset in bytes.
     * Keep this in mind working with multi byte encodings.
     *
     * @return int
     */
    public function getByteOffset(): int
    {
        return $this->byteOffset;
    }

    /**
     * Example match: http://example.com -> http://example.com
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Example match: http://example.com -> http
     *
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * Example match: user:password@example.com -> user:password
     *
     * @return string|null
     */
    public function getUserinfo(): ?string
    {
        return $this->userinfo;
    }

    /**
     * Example match: example.com -> example.com
     *
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Example match: example.com -> com
     *
     * @return string|null
     */
    public function getTld(): ?string
    {
        return $this->tld;
    }

    /**
     * Example match: example.com:80 -> 80
     *
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Example match: example.com/path/to?q=hello -> /path/to?q=hello
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $string
     * @return string|null
     */
    private function getStringOrNull(?string $string): ?string
    {
        return $this->isEmpty($string) ? null : $string;
    }

    /**
     * @param string|null $string
     * @return int|null
     */
    private function getIntOrNull(?string $string): ?int
    {
        return $this->isEmpty($string) ? null : (int) $string;
    }

    /**
     * @param string|null $string
     * @return bool
     */
    private function isEmpty(?string $string): bool
    {
        return $string === null || $string === '';
    }
}
