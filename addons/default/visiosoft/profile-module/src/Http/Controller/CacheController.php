<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AddblockExtension\Command\addBlock;

class CacheController extends PublicController
{

    public function getUserInfo()
    {
        $user = auth()->user();
        $user = $user ? $user->name() : $user;

        $getAddBlockHtml = new addBlock('navigation/dropdown', []);
        $addBlockHtml = $getAddBlockHtml->handle();

        return ['userName' => $user, 'addBlockHtml' => $addBlockHtml];
    }
}
