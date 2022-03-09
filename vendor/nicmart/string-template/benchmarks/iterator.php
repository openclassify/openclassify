<?php
/**
 * This file is part of library-template
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

/**
 * This is a basic benchmark test for NestedKeyIterator... it's 3 times faster to a
 * without-iterator version! (a naive version, though)
 */
include '../vendor/autoload.php';

$ary = array(
    'a' => 'b',
    'c' => 'd',
    'e' => array('f' => 'g', 'h' => 'i', 'l' => array('m', 'n', 'o' => 'p'))
);

$iterator = new \StringTemplate\NestedKeyIterator(new \RecursiveArrayIterator($ary));

$iterateWithIterator = function (&$ary) use ($iterator) {
    foreach ($iterator as $key => $value) {
        $i = $key . $value;
    }
};

/**
 * This could be optimized.
 * @param $ary
 * @param array $keyStack
 */
$iterateWithoutIterator
        = function (&$ary, $keyStack = array())
{
    global $iterateWithoutIterator;
    $keyValues = array();
    foreach ($ary as $key => $value) {
        if (!is_array($value)) {
            $nestedKey = implode('.', array_merge($keyStack, array($key)));
            $keyValues[$nestedKey] = $value;
        } else {
            $keyStack2 = $keyStack;
            $keyStack2[] = $key;
            $keyValues = array_merge($keyValues, $iterateWithoutIterator($value, $keyStack2));
        }
    }
};

function benchmark($f, $ary, $title = '', $iterations = 10000 )
{
    echo '<br><b>', $title, '</b><br>';
    $start = microtime(true);
    for ($i = 0; $i < $iterations; $i++)
        $f($ary);
    $time = microtime(true) - $start;
    echo 'Time: ', $time, '<br>';
    echo 'Average: ', $time / $iterations, '<br>';
}

benchmark($iterateWithIterator, $ary, 'With Iterator');
benchmark($iterateWithoutIterator, $ary, 'Without Iterator');