<?php

namespace VStelmakh\UrlHighlight\Util;

/**
 * Store unique string values. Case insensitive.
 *
 * @internal
 */
class CaseInsensitiveSet
{
    /**
     * @var array&string[]
     */
    private $values = [];

    /**
     * @internal
     * @param array&string[] $values
     */
    public function __construct(array $values = [])
    {
        $this->setFromArray($values);
    }

    /**
     * @return array&string[]
     */
    public function toArray(): array
    {
        return array_values($this->values);
    }

    /**
     * @param string $value
     */
    public function add(string $value): void
    {
        $value = $this->normalize($value);
        $this->values[$value] = $value;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->values);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function contains(string $value): bool
    {
        $value = $this->normalize($value);
        return isset($this->values[$value]);
    }

    /**
     * @param array&string[] $array
     * @return void
     */
    private function setFromArray(array $array): void
    {
        foreach ($array as $value) {
            $this->add($value);
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
