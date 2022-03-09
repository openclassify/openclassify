<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace StringTemplate;

class NestedKeyArray implements \ArrayAccess, \IteratorAggregate
{
    private $array;
    private $keySeparator;

    /**
     * @param array $array
     * @param string $keySeparator
     */
    public function __construct(array &$array, $keySeparator = '.')
    {
        $this->array = $array;
        $this->keySeparator = $keySeparator;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new NestedKeyIterator(new RecursiveArrayOnlyIterator($this->array));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        $keys = explode($this->keySeparator, $offset);
        $ary = &$this->array;

        foreach ($keys as $key) {
            if (!isset($ary[$key]))
                return false;
            $ary = &$ary[$key];
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        $keys = explode($this->keySeparator, $offset);
        $result = &$this->array;

        foreach ($keys as $key) {
            $result = &$result[$key];
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->setNestedOffset($this->array, explode($this->keySeparator, $offset), $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->unsetNestedOffset($this->array, explode($this->keySeparator, $offset));
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return $this->array;
    }

    /**
     * @param array $target
     * @param array $offsets
     * @param $value
     * @return $this
     */
    private function setNestedOffset(array &$target, array $offsets, $value)
    {
        $currKey = array_shift($offsets);

        if (!$offsets) {
            $target[$currKey] = $value;
        }  else {
            if (!isset($target[$currKey]))
                $target[$currKey] = array();
            $this->setNestedOffset($target[$currKey], $offsets, $value);
        }

        return $this;
    }

    /**
     * @param array $target
     * @param array $offsets
     * @return $this
     */
    private function unsetNestedOffset(array &$target, array $offsets)
    {
        $currKey = array_shift($offsets);

        if (!$offsets) {
            unset($target[$currKey]);
        } elseif (isset($target[$currKey])) {
            $this->unsetNestedOffset($target[$currKey], $offsets);
        }

        return $this;
    }
}
