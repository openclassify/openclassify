<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Illuminate\Support\Str;
use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;

class AddSlug
{
    protected $ad;

    public function __construct(AdvInterface $ad)
    {
        $this->ad = $ad;
    }

    public function handle()
    {
        if (!$this->ad->slug && $this->ad->name) {
            $this->ad->update([
                'slug' => Str::slug($this->ad->name)
            ]);
        }
    }
}
