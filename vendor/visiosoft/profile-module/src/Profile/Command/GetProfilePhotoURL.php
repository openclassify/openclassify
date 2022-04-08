<?php namespace Visiosoft\ProfileModule\Profile\Command;

use Anomaly\Streams\Platform\Image\Command\MakeImageInstance;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GetProfilePhotoURL
{
    use DispatchesJobs;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        return $this->user->file ? $this->user->file->make()->url() : $this->dispatchNow(
            new MakeImageInstance(
                'visiosoft.module.profile::images/profile-default.png',
                'img'
            )
        )->url();
    }
}
