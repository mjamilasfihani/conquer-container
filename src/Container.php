<?php

namespace Conquer\Container;

use CodeIgniter\Controller;
use Conquer\Container\Traits\WithReflectionClass;
use Conquer\Container\Traits\WithReflectionConstructor;
use ReflectionMethod;
use ReflectionParameter;

final class Container
{
    use WithReflectionClass;
    use WithReflectionConstructor;

    private string $controller;

    private function __construct(string $controller)
    {
        $this->controller = $controller;
    }

    public static function withController(string $name): self
    {
        return new self($name);
    }

    public function initialize()
    {
        $this->setReflectionClass($this->controller);

        $reflectionClass = $this->getReflectionClass();

        $this->setReflectionConstructor($reflectionClass);

        return $this;
    }

    public function build(): Controller
    {
        $constructor = $this->getReflectionConstructor();

        return ($constructor !== null) ? new $this->controller(...$this->getInjectedClass($constructor)) : new $this->controller();
    }

    private function getInjectedClass(ReflectionMethod $constructor): array
    {
        $injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            $injected_class = $this->getInjectedClassName($param);
            $injector[$key] = new $injected_class();
        }

        return $injector;
    }

    private function getInjectedClassName(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }
}
