<?php namespace Visiosoft\ClassifiedsModule\Classified\Command;

use Illuminate\Support\Str;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedInterface;

class AddSlug
{
    protected $classified;

    public function __construct(ClassifiedInterface $classified)
    {
        $this->classified = $classified;
    }

    public function handle()
    {
        if (!$this->classified->slug && $this->classified->name) {
            $this->classified->update([
                'slug' => Str::slug($this->classified->name)
            ]);
        }
    }
}
