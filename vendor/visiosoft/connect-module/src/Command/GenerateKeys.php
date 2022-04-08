<?php namespace Visiosoft\ConnectModule\Command;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Console\Kernel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use phpseclib3\Crypt\RSA;
use phpseclib\Crypt\RSA as LegacyRSA;

/**
 * Class GenerateKeys
 *

 */
class GenerateKeys
{
    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application, Kernel $console, ClientRepository $clients)
    {
        if (file_exists($application->getStoragePath('oauth-private.key'))) {
            return;
        }

        Artisan::call('migrate');

        $this->keys();
        $provider = in_array('users', array_keys(config('auth.providers'))) ? 'users' : null;
        $clients->createPasswordGrantClient(null, config('app.name').' Password Grant Client', 'http://localhost', $provider);
    }

    public function keys()
    {
        [$publicKey, $privateKey] = [
            Passport::keyPath('streams/default/oauth-public.key'),
            Passport::keyPath('streams/default/oauth-private.key'),
        ];

        if (class_exists(LegacyRSA::class)) {
            $keys = (new LegacyRSA)->createKey($this->input ? (int)$this->option('length') : 4096);

            file_put_contents($publicKey, Arr::get($keys, 'publickey'));
            file_put_contents($privateKey, Arr::get($keys, 'privatekey'));
        } else {
            $key = RSA::createKey(4096);

            file_put_contents($publicKey, (string)$key->getPublicKey());
            file_put_contents($privateKey, (string)$key);
        }

        chmod(storage_path('streams/default/oauth-private.key'), 0600);
        chmod(storage_path('streams/default/oauth-public.key'), 0600);
    }
}
