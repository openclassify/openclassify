<?php
/*
 * This file is part of StringTemplate.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StringTemplate;

/**
 * Class Engine
 *
 * Replace placeholder in strings with nested (array) values.
 *
 * Example:
 * <code>
 * $engine->render('This is {a} and these are {c.0} and {c.1}', ['a' => 'b', 'c' => ['d', 'e']]);
 * //Prints "This is b and these are d and e"
 * </code>
 */
class Engine extends AbstractEngine
{
    /**
     * {@inheritdoc}
     */
    public function render($template, $value)
    {
        $result = $template;
        if (!is_array($value))
            $value = array('' => $value);

        foreach (new NestedKeyIterator(new RecursiveArrayOnlyIterator($value)) as $key => $value) {
            $result = str_replace($this->left . $key . $this->right, $value, $result);
        }

        return $result;
    }
}