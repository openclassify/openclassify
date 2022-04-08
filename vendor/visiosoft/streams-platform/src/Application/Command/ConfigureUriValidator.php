<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Http\Routing\Matching\CaseInsensitiveUriValidator;
use Illuminate\Routing\Matching\UriValidator;
use Illuminate\Routing\Route;

/**
 * Class ConfigureUriValidator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureUriValidator
{

    /**
     * Handle the command.
     */
    public function handle()
    {
        Route::$validators = array_filter(
            array_merge(
                Route::getValidators(),
                [new CaseInsensitiveUriValidator()]
            ),
            function ($validator) {
                return get_class($validator) != UriValidator::class;
            }
        );
    }
}
