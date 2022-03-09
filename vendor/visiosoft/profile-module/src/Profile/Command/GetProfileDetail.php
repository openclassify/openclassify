<?php namespace Visiosoft\ProfileModule\Profile\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

class GetProfileDetail
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(UserRepositoryInterface $user)
    {
        if ($this->id) {
            return $user->find($this->id);
        }
        return null;
    }
}
