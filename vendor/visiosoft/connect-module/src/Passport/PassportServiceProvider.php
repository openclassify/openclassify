<?php namespace Visiosoft\ConnectModule\Passport;

use Visiosoft\ConnectModule\Guard\RequestGuard;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Guards\TokenGuard;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider as IlluminatePassportServiceProvider;
use Laravel\Passport\PassportUserProvider;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\ResourceServer;

/**
 * Class PassportServiceProvider
 *
 * This is a temp fix for the following error message when using the PHP League OAuth 2 server
 * You must set the encryption key going forward to improve the security of this library - see this
 * page for more information https://oauth2.thephpleague.com/v5-security-improvements/
 *

 */
class PassportServiceProvider extends IlluminatePassportServiceProvider
{

    /**
     * Make the authorization service instance.
     *
     * @return AuthorizationServer
     */
    public function makeAuthorizationServer()
    {
        $server = new AuthorizationServer(
            $this->app->make(\Laravel\Passport\Bridge\ClientRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\AccessTokenRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\ScopeRepository::class),
            'file://' . Passport::keyPath('oauth-private.key'),
            'file://' . Passport::keyPath('oauth-public.key')
        );

        return $server;
    }

    /**
     * Make an instance of the token guard that incorporates
     * the Users module permission system on top of Passport.
     *
     * @param  array $config
     * @return \Illuminate\Auth\RequestGuard
     */
    protected function makeGuard(array $config)
    {
        return new RequestGuard(
            function ($request) use ($config) {
                return (new TokenGuard(
                    $this->app->make(ResourceServer::class),
                    new PassportUserProvider(Auth::createUserProvider($config['provider']), $config['provider']),
                    $this->app->make(TokenRepository::class),
                    $this->app->make(ClientRepository::class),
                    $this->app->make('encrypter')
                ))->user($request);
            }, $this->app['request']
        );
    }

}
