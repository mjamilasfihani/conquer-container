<?php

namespace Conquer\Container\Libraries\Traits;

use Conquer\Container\Container;
use ReflectionMethod;
use ReflectionParameter;

trait WithInjectedClass
{
    protected function setInjectedClass(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }

    protected function getInjectedClass(ReflectionMethod $constructor, bool $calling_itself = false): array
    {
        $injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            // initialize the injected class name
            $class = $this->setInjectedClass($param);

            // re-define the constructor to support child injection
            $constructor = ($calling_itself === false) ? Container::withClass($class)->initialize()->getReflectionConstructor() : null;

            // building up the library
            $injector[$key] = (null !== $constructor) ? new $class(...$this->getInjectedClass($constructor, true)) : new $class();
        }

        return $injector;
    }
}
