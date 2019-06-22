<?php namespace Visiosoft\ProfileModule\Profile\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface ProfileRepositoryInterface extends EntryRepositoryInterface
{
    public function getUser($id);

    public function getProfile($id);

    public function validPasswordByEmail($email);
    public function validPasswordByUsername($username);

    public function updateUserField($fields);
    public function changePassword($fields,$password);
}
