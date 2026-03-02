<?php namespace Visiosoft\GlobalHelperExtension\Support\Command;


class CheckInstalled
{
    protected $slug;
    protected $type;

    public function __construct($slug, $type)
    {
        $this->slug = $slug;
        $this->type = $type;
    }

    public function handle()
    {
        if ($this->type === 'module'){
            if ($addon = app('module.collection')->get($this->slug)) {
                return $addon->installed;
            }
            return false;
        }elseif ($this->type === 'extension'){
            if ($addon = app('extension.collection')->get($this->slug)) {
                return $addon->installed;
            }
            return false;
        }
    }
}
