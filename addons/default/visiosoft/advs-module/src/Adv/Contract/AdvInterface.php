<?php namespace Visiosoft\AdvsModule\Adv\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface AdvInterface extends EntryInterface
{
    public function is_active();
}
