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

/**
 * Class RecursiveArrayOnlyIterator
 *
 * It's like RecursiveArrayIterator, but prevents it to iterate through objects
 *
 * @package StringTemplate
 */
class RecursiveArrayOnlyIterator extends \RecursiveArrayIterator
{
    /**
     * {@inheritdoc}
     */
    public function hasChildren()
    {
        return is_array($this->current()) || $this->current() instanceof \Traversable;
    }

}