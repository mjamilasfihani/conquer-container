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

    private string $class;

    private function __construct(string $controller)
    {
        $this->class = $controller;
    }

    public static function withController(string $name): self
    {
        return new self($name);
    }

    public function initialize()
    {
        $this->setReflectionClass($this->class);

        $reflectionClass = $this->getReflectionClass();

        $this->setReflectionConstructor($reflectionClass);

        return $this;
    }

    public function build(): Controller
    {
        $constructor = $this->getReflectionConstructor();

        return ($constructor !== null) ? new $this->class(...self::getInjectedClass($constructor, false)) : new $this->class();
    }

    private static function getInjectedClass(ReflectionMethod $constructor, bool $calling_itself = false): array
    {
        $injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            // initialize the injected class name
            $container = self::getInjectedClassName($param);

            // re-define the constructor to support child injection
            $constructor = ($calling_itself === false) ? self::withController($container)->initialize()->getReflectionConstructor() : null;

            // building up the library
            $injector[$key] = (null !== $constructor) ? new $container(...self::getInjectedClass($constructor, true)) : new $container();
        }

        return $injector;
    }

    private static function getInjectedClassName(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }
}
