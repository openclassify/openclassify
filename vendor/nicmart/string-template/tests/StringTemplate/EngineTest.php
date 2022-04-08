<?php
/*
 * This file is part of StringTemplate.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace StringTemplate\Test;

use PHPUnit\Framework\TestCase;
use StringTemplate\Engine;

/**
 * Unit tests for class Engine
 */
class EngineTest extends TestCase
{
    public function testRenderWithScalarReplacement()
    {
        $engine = new Engine('<', '>');
        $this->assertEquals('my string and <your> string', $engine->render('my <> and <your> <>', 'string'));
    }

    public function testRender()
    {
        $engine = new Engine();
        $this->assertEquals(
            'Oh! The cat jumped onto the table',
            $engine->render(
                'Oh! {subj.det} {subj.np} {verb} onto {w.where.det} {w.where.np}',
                array(
                    'verb' => 'jumped',
                    'subj' => array('det' => 'The', 'np' => 'cat'),
                    'w' => array('where' => array('det' => 'the', 'np' => 'table'))
                )
            )
        );
    }

    public function testRenderWithObjectValues()
    {
        $engine = new Engine;
        $this->assertEquals('foo', $engine->render('{value}', array('value' => new ObjectMock())));
    }
}

class ObjectMock
{
   function __toString()
   {
       return 'foo';
   }
}