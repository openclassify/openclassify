<?php namespace Visiosoft\ProfileModule\Adress\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface AdressInterface extends EntryInterface
{
    public function getAdress($id = null);

    public function getAdressFirst($id);

    public function getUserAdress($id = null);

    public function getCountry();

    public function getCity();
}
