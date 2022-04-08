<?php

namespace VStelmakh\UrlHighlight\Util;

/**
 * Store unique key, values. Case insensitive.
 *
 * @internal
 */
class CaseInsensitiveMap
{
    /**
     * @var array&string[]
     */
    private $map = [];

    /**
     * @internal
     * @param mixed[]&array $values
     */
    public function __construct(array $values = [])
    {
        $this->setFromArray($values);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void
    {
        $key = $this->normalize($key);
        $this->map[$key] = $value;
    }

    /**
     * @return string[]&array
     */
    public function getKeys(): array
    {
        return array_keys($this->map);
    }

    /**
     * @return mixed[]&array
     */
    public function getValues(): array
    {
        return array_values($this->map);
    }

    /**
     * @return mixed[]&array
     */
    public function toArray(): array
    {
        return $this->map;
    }

    /**
     * @param mixed[]&array $values
     */
    private function setFromArray(array $values): void
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @param string $string
     * @return string
     */
    private function normalize(string $string): string
    {
        return mb_strtolower($string);
    }
}
