<?php

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Support\Parser;
use Anomaly\Streams\Platform\Support\Str;
use Anomaly\Streams\Platform\Support\Template;
use Anomaly\Streams\Platform\Support\Value;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists('app_storage_path')) {

    /**
     * Get the storage path for the application.
     *
     * @param  string $path
     * @return string
     */
    function app_storage_path($path = '')
    {
        /* @var Application $application */
        $application = app(Application::class);

        return storage_path('streams/' . $application->getReference()) . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('array_value')) {

    /**
     * Get the literal key value of an array
     * without any of the funny business.
     *
     * @param $array
     * @param $key
     * @param null $default
     * @return mixed
     */
    function array_value($array, $key, $default = null)
    {
        if (isset($array[$key]) || array_key_exists($key, $array)) {
            return $array[$key];
        }

        return $default;
    }
}

if (!function_exists('str_humanize')) {

    /**
     * Humanize the string.
     *
     * @param        $target
     * @param string $separator
     * @return string
     */
    function str_humanize($target, $separator = '_')
    {
        return app(Str::class)->humanize($target, $separator);
    }
}

if (!function_exists('humanize')) {

    /**
     * Humanize the string.
     *
     * @param        $target
     * @param string $separator
     * @return string
     */
    function humanize($target, $separator = '_')
    {
        return app(Str::class)->humanize($target, $separator);
    }
}

if (!function_exists('parse')) {

    /**
     * Parse the target with data.
     *
     * @param       $target
     * @param array $data
     * @return mixed    The parsed target.
     */
    function parse($target, array $data = [])
    {
        return app(Parser::class)->parse($target, $data);
    }
}

if (!function_exists('render')) {

    /**
     * Render the string template.
     *
     * @param       $template
     * @param array $payload
     * @return string
     */
    function render($template, array $payload = [])
    {
        return app(Template::class)->render($template, $payload);
    }
}

if (!function_exists('valuate')) {

    /**
     * Make a valuation.
     *
     * @param        $parameters
     * @param        $entry
     * @param string $term
     * @param array $payload
     * @return mixed
     */
    function valuate($parameters, $entry, $term = 'entry', $payload = [])
    {
        return app(Value::class)->make($parameters, $entry, $term, $payload);
    }
}

if (!function_exists('data')) {

    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed $target
     * @param  string|array $key
     * @param  mixed $default
     * @return mixed
     */
    function data($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        while (!is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }

                $result = Arr::pluck($target, $key);

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } elseif (is_object($target) && method_exists($target, $segment)) {
                // This is different than laravel..
                $target = call_user_func([$target, $segment]);
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (!function_exists('filesize_for_humans')) {

    /**
     * Humanize the filesize
     *
     * @param      integer $bytes    The bytes
     * @param      integer $decimals The decimals
     * @return     string
     */
    function filesize_for_humans($bytes, $decimals = 2)
    {
        $size   = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        $factor = (int) floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . '&nbsp;' . @$size[$factor];
    }
}

if (!function_exists('template')) {

    /**
     * Template data helper function.
     *
     * @return \Anomaly\Streams\Platform\View\ViewTemplate
     */
    function template()
    {
        $arguments = func_get_args();

        /* @var \Anomaly\Streams\Platform\View\ViewTemplate $template */
        $template = app(\Anomaly\Streams\Platform\View\ViewTemplate::class);

        if (empty($arguments)) {
            return $template;
        }

        if (is_string($arguments[0])) {
            return $template->get(...$arguments);
        }

        if (!is_array($arguments[0])) {
            throw new Exception(
                'When setting a value in the template data, you must pass an array of key / value pairs.'
            );
        }

        foreach ($arguments[0] as $key => $value) {
            $template->set($key, $value);
        }

        return $template;
    }
}

if (!function_exists('console')) {

    /**
     * Return the console instance.
     *
     * @return \Anomaly\Streams\Platform\Console\Kernel
     */
    function console()
    {
        return app(\Anomaly\Streams\Platform\Console\Kernel::class);
    }
}
