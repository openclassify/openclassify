<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace StringTemplate\Test;


use PHPUnit\Framework\TestCase;
use StringTemplate\NestedKeyArray;

class NestedKeyArrayTest extends TestCase
{
    /**
     * @var array
     */
    protected $ary;

    /**
     * @var NestedKeyArray
     */
    protected $nestedKeyAry;

    public function setUp(): void
    {
        $this->ary = array(
            'a' => 'b',
            'c' => array(
                'd' => 'e',
                'f' => array(
                    'g' => 'h'
                )
            ),
            2 => 'i'
        );

        $this->nestedKeyAry = new NestedKeyArray($this->ary);
    }

    public function testToArray()
    {
        $this->assertEquals($this->ary, $this->nestedKeyAry->toArray());
    }

    public function testOffsetGet()
    {
        $this->assertEquals('b', $this->nestedKeyAry['a']);
        $this->assertEquals(
            array(
                'd' => 'e',
                'f' => array(
                    'g' => 'h'
                )
            ),
            $this->nestedKeyAry['c']);
        $this->assertEquals('e', $this->nestedKeyAry['c.d']);
        $this->assertEquals('h', $this->nestedKeyAry['c.f.g']);
        $this->assertEquals('i', $this->nestedKeyAry['2']);
        $this->assertEquals('i', $this->nestedKeyAry[2]);
    }

    public function testOffsetSet()
    {
        $this->nestedKeyAry['a'] = 'bb';
        $this->nestedKeyAry['c.f.g'] = 'hh';
        $ary = $this->nestedKeyAry->toArray();

        $this->assertEquals('bb', $ary['a']);
        $this->assertEquals('hh', $ary['c']['f']['g']);
    }

    public function testOffsetUnset()
    {
        unset($this->nestedKeyAry['a']);
        unset($this->nestedKeyAry['c.f.g']);
        $ary = $this->nestedKeyAry->toArray();

        $this->assertFalse(isset($ary['a']));
        $this->assertFalse(isset($ary['c']['f']['g']));
    }

    public function testOffsetExists()
    {
        $this->assertTrue(isset($this->nestedKeyAry['a']));
        $this->assertTrue(isset($this->nestedKeyAry['c.f.g']));
        $this->assertTrue(isset($this->nestedKeyAry['c.f']));

        $this->assertFalse(isset($this->nestedKeyAry['aa']));
        $this->assertFalse(isset($this->nestedKeyAry['c.ff']));
        $this->assertFalse(isset($this->nestedKeyAry['c.f.gg']));
    }

    public function testIteration()
    {
        $flattenAry = array();
        foreach ($this->nestedKeyAry as $key => $value)
        {
            $flattenAry[$key] = $value;
        }

        $this->assertEquals(
            array(
                'a' => 'b',
                'c.d' => 'e',
                'c.f.g' => 'h',
                '2' => 'i'
            ),
            $flattenAry
        );
    }
}
 