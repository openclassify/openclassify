<?php namespace Visiosoft\AdvsModule\Adv;

use Visiosoft\AdvsModule\Adv\Contract\AdvInterface;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Illuminate\Routing\Route;

class AdvResolver {
    protected $adv;

    protected $route;

    public function __construct(AdvRepositoryInterface $adv, Route $route)
    {
        $this->adv = $adv;
        $this->route = $route;
    }

    public function resolve() {
        return $this->adv->find($this->route->parameter('id'));
    }
}