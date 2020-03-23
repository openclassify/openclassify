<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;

class CacheController extends PublicController
{
    public function getUserInfo()
    {
        $user = auth()->user();
        $response = $user ? $user->first_name . ' ' . $user->last_name : $user;

        return ['userName' => $response];
    }
}
