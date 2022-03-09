<?php namespace Visiosoft\AdvsModule\Adv\Command;

use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;

class isActive
{

    /**
     * @var $name
     */
    protected $name;

    /**
     * @var $type
     */
    protected $type;

    /**
     * @var $project
     */
    protected $project;

    /**
     * isActive Module constructor.
     * @param $name
     */
    public function __construct($name, $type, $project)
    {
        $this->name = $name;
        $this->type = $type;
        $this->project = $project;
    }


    public function handle()
    {
        $module = app('module.collection')->get($this->project . '.' . $this->type . '.' . $this->name);
        if ($module) {
            return $module->isInstalled();
        } else {
            return false;
        }
    }
}
