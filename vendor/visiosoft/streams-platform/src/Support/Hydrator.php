<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Hydrator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Hydrator
{

    /**
     * Hydrate an object with parameters.
     *
     * @param        $object
     * @param  array $parameters
     * @return mixed
     */
    public function hydrate($object, array $parameters)
    {
        foreach ($parameters as $parameter => $value) {
            $method = camel_case('set_' . $parameter);

            if (method_exists($object, $method)) {
                $object->{$method}($value);
            }
        }

        return $object;
    }
}
