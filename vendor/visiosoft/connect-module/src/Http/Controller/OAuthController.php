<?php namespace Visiosoft\ConnectModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\HasApiTokens;

/**
 * Class OAuthController
 *

 */
class OAuthController extends PublicController
{

    /**
     * Redirect to an auth token request.
     *
     * @param Guard            $auth
     * @param ClientRepository $clients
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function request(Guard $auth, ClientRepository $clients)
    {
        /* @var UserInterface|HasApiTokens $user */
        $user = $auth->user();

        /* @var Client $client */
        $client = $clients->find($this->request->get('client'));

        if (!$user || $user->getId() != $client->user_id) {
            abort(403);
        }

        $query = http_build_query(
            [
                'client_id'     => $client->id,
                'redirect_uri'  => $client->redirect,
                'scope'         => $this->request->get('scope'),
                'response_type' => 'code',
            ]
        );

        return $this->redirect->to('oauth/authorize?' . $query);
    }
}
