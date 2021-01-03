<?php namespace Visiosoft\ProfileModule\Adress\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface AdressRepositoryInterface extends EntryRepositoryInterface
{
    public function findByUser($user_id);

    public function createAddress($name, $user_id, $first_name, $last_name, $country_id, $city_id, $content, $gsm_phone);
}
