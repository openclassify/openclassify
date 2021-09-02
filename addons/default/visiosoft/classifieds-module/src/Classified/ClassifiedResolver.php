<?php namespace Visiosoft\ClassifiedsModule\Classified;

use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedInterface;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Illuminate\Routing\Route;

class ClassifiedResolver {
    protected $classified;

    protected $route;

    public function __construct(ClassifiedRepositoryInterface $classified, Route $route)
    {
        $this->classified = $classified;
        $this->route = $route;
    }

    public function resolve() {
        return $this->classified->find($this->route->parameter('id'));
    }
}