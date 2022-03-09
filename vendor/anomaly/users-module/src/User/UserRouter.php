<?php namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Entry\EntryRouter;
use Illuminate\Encryption\Encrypter;

class UserRouter extends EntryRouter
{
    /**
     * Return the activate route.
     *
     * @param Encrypter $encrypter
     * @param array     $parameters
     *
     * @return string
     */
    public function activate(Encrypter $encrypter, array $parameters = [])
    {
        $parameters['email'] = $encrypter->encrypt($this->entry->getEmail());
        $parameters['code']  = $encrypter->encrypt($this->entry->getActivationCode());

        return $this->url->route('anomaly.module.users::users.activate', $parameters);
    }

    /**
     * Return the password reset route.
     *
     * @param Encrypter $encrypter
     * @param array     $parameters
     */
    public function reset(Encrypter $encrypter, array $parameters = [])
    {
        $parameters['email'] = $encrypter->encrypt($this->entry->getEmail());
        $parameters['code']  = $encrypter->encrypt($this->entry->getResetCode());

        return $this->url->route('anomaly.module.users::users.reset', $parameters);
    }
}
