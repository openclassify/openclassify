<?php namespace Anomaly\Streams\Platform\Exception\Displayer;

use Illuminate\Http\Response;

/**
 * Class ViewDisplayer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewDisplayer extends \GrahamCampbell\Exceptions\Displayers\ViewDisplayer
{

    /**
     * Get the error response associated with the given exception.
     *
     * @param \Exception $exception
     * @param string     $id
     * @param int        $code
     * @param string[]   $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function display(\Exception $exception, $id, $code, array $headers)
    {
        $info = $this->info->generate($exception, $id, $code);

        return new Response(
            $this->factory->make("streams::errors/{$code}", $info),
            $code,
            array_merge($headers, ['Content-Type' => $this->contentType()])
        );
    }

    /**
     * Can we display the exception?
     *
     * @param \Exception $original
     * @param \Exception $transformed
     * @param int        $code
     *
     * @return bool
     */
    public function canDisplay(\Exception $original, \Exception $transformed, $code)
    {
        return $this->factory->exists("streams::errors/{$code}");
    }
}
