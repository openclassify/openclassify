<?php namespace Visiosoft\ProfileModule\Adress\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface AdressRepositoryInterface extends EntryRepositoryInterface
{
    public function findByUser($user_id);
}
