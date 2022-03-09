<?php namespace Visiosoft\ProfileModule\Profile\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;

class UserInitials
{
    use DispatchesJobs;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $words = explode(" ", $this->user->name());
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        return $acronym;
    }
}
