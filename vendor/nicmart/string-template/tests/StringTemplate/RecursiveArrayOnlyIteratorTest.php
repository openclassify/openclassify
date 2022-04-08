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
use StringTemplate\RecursiveArrayOnlyIterator;

class RecursiveArrayOnlyIteratorTest extends TestCase
{
    public function testHasChildrenWithScalarValue()
    {
        $it = new RecursiveArrayOnlyIterator(array('a' => 'b'));

        $this->assertFalse($it->hasChildren());
    }

    public function testHasChildrenWithArrayValue()
    {
        $it = new RecursiveArrayOnlyIterator(array('a' => array()));

        $this->assertTrue($it->hasChildren());
    }

    public function testHasChildrenWithObjectValue()
    {
        $it = new RecursiveArrayOnlyIterator(array('a' => new \stdClass()));

        $this->assertFalse($it->hasChildren());
    }
}
 