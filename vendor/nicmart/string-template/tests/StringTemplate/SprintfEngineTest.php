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
use StringTemplate\SprintfEngine;

/**
 * Unit tests for class Engine
 */
class SprintfEngineTest extends TestCase
{

    public function testRender()
    {
        $engine = new SprintfEngine();
        $this->assertEquals(
            sprintf('Oh! %s %s jumped onto %s (%e) table', 'The', 'cat', 1, 1),
            $engine->render(
                'Oh! {subj.det%s} {subj.np%s} {verb} onto {w.where.number%s} ({w.where.number%e}) {w.where.np}',
                array(
                    'verb' => 'jumped',
                    'subj' => array('det' => 'The', 'np' => 'cat'),
                    'w' => array('where' => array('number' => 1, 'np' => 'table'))
                )
            )
        );
    }

    public function testRenderWithObjectValues()
    {
        $engine = new SprintfEngine();
        $this->assertEquals(
            'foo',
            $engine->render(
                '{val%s}',
                array('val' => new ObjectMockForSprintf())
            )
        );
    }

    public function testRenderWithAdditionalFormatting()
    {
        $engine = new SprintfEngine();
        $this->assertEquals(
            'I have 1.2 (1.230000E+0) apples.',
            $engine->render(
                "I have {num%.1f} ({num%.6E}) {fruit}.",
                array(
                    'num' => 1.23,
                    'fruit' => 'apples'
                )
            )
        );
    }
}

class ObjectMockForSprintf
{
    function __toString()
    {
        return 'foo';
    }
}