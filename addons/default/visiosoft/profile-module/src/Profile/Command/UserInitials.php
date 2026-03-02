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
            $acronym .= mb_substr($w, 0, 1);
        }

        return $acronym;
    }
}
