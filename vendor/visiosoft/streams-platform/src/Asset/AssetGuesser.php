<?php namespace Anomaly\Streams\Platform\Asset;

/**
 * Class AssetGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssetGuesser
{

    /**
     * Guess filters based on the file provided.
     *
     * @param $file
     * @return array
     */
    public static function guess($file)
    {
        $filters = [];

        if (ends_with($file, '.less')) {
            $filters[] = 'less';
        }

        if (ends_with($file, '.styl')) {
            $filters[] = 'styl';
        }

        if (ends_with($file, '.scss')) {
            $filters[] = 'scss';
        }

        if (ends_with($file, '.coffee')) {
            $filters[] = 'coffee';
        }

        if (ends_with($file, '.js')) {
            $filters[] = 'separate';
        }

        return $filters;
    }
}
