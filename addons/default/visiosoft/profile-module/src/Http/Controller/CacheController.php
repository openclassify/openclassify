<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Visiosoft\AddblockExtension\Command\addBlock;

class CacheController extends PublicController
{
    public function getUserInfo()
    {
        $user = auth()->user();
        $profile_img =  $user ? $this->dispatch(
            new MakeImageInstance($user->file ?: 'theme::images/no_profile.svg', 'img')
        )->url() : $user;
        $user = $user ? $user->name() : $user;

        $getAddBlockHtml = new addBlock('navigation/dropdown', []);
        $addBlockHtml = $getAddBlockHtml->handle();

        return ['userName' => $user, 'profileImg' => $profile_img, 'addBlockHtml' => $addBlockHtml];
    }
}
