<?php

namespace Modules\Listing\States;

use A909M\FilamentStateFusion\Concerns\StateFusionInfo;
use A909M\FilamentStateFusion\Contracts\HasFilamentStateFusion;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ListingStatus extends State implements HasFilamentStateFusion
{
    use StateFusionInfo;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(ActiveListingStatus::class)
            ->allowAllTransitions()
            ->ignoreSameState();
    }
}
