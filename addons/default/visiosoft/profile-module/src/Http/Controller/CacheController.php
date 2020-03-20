<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Http\Request;

class CacheController extends PublicController
{
    public function getUserInfo(Request $request, UserRepositoryInterface $userRepository)
    {
        $user = $userRepository->find($request->userId);

        return ['userName' => $user->first_name . ' ' . $user->last_name];
    }
}
