<?php namespace Anomaly\Streams\Platform\Database\Migration\Stream\Guesser;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class TranslationGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TranslationGuesser
{

    /**
     * Guess the stream names.
     *
     * @param Migration $migration
     */
    public function guess(Migration $migration)
    {

        /**
         * If we don't have any addon then
         * we can't automate anything.
         *
         * @var Addon $addon
         */
        if (!$addon = $migration->getAddon()) {
            return;
        }

        $locale = config('app.fallback_locale');

        $stream = $migration->getStream();

        foreach (['name', 'description'] as $key) {
            if (is_null(array_get($stream, $locale . '.' . $key))) {
                $stream = array_add(
                    $stream,
                    $locale . '.' . $key,
                    $addon->getNamespace('stream.' . array_get($stream, 'slug') . '.' . $key)
                );
            }
        }

        $migration->setStream($stream);
    }
}
