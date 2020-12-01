<?php namespace Visiosoft\ProfileModule\Adress\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface AdressInterface extends EntryInterface
{
    public function getCountry();
}
