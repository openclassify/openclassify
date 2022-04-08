<?php

namespace tubalmartin\CssMin\Tests\FineDiff\Render;

use cogpowered\FineDiff\Render\Renderer;

class Cli extends Renderer
{
    public function callback($opcode, $from, $from_offset, $from_len)
    {
        if ($opcode === 'c') {
            $text = substr($from, $from_offset, $from_len);
        } elseif ($opcode === 'd') {
            $deletion = substr($from, $from_offset, $from_len);

            if (strcspn($deletion, " \n\r") === 0) {
                $deletion = str_replace(array("\n","\r"), array('\n','\r'), $deletion);
            }

            $text = "\x1b[97m\x1b[41m".$deletion."\x1b[0m";
        } else /* if ( $opcode === 'i' ) */ {
            $text = "\x1b[97m\x1b[42m".substr($from, $from_offset, $from_len)."\x1b[0m";
        }

        return $text;
    }
}