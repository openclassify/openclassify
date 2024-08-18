<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\Streams\Platform\Ui\Form\FormCriteria;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordFormCriteria
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ResetPasswordFormCriteria extends FormCriteria
{

    /**
     * Fired just before building.
     *
     * @param Encrypter $encrypter
     * @param Request   $request
     */
    public function onInitialized(Encrypter $encrypter, Request $request)
    {
        if ($code = $request->query('code')) {
            array_set($this->parameters, 'code', $encrypter->decrypt($code));
        }

        if ($email = $request->query('email')) {
            array_set($this->parameters, 'email', $encrypter->decrypt($email));
        }
    }
}
