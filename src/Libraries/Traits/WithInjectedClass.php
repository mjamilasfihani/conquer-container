<?php

namespace Conquer\Container\Libraries\Traits;

use Conquer\Container\Container;
use ReflectionMethod;
use ReflectionParameter;

trait WithInjectedClass
{
    private bool $loopItSelf = false;

    protected function asItSelfIsEnabled()
    {
        $this->loopItSelf = true;

        return $this;
    }

    protected function asItSelfIsDisabled()
    {
        $this->loopItSelf = false;

        return $this;
    }

    protected function setInjectedClass(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }

    protected function getInjectedClass(ReflectionMethod $constructor): array
    {
        $injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            // initialize the injected class name
            $class = $this->setInjectedClass($param);

            // re-define the constructor to support child injection
            $constructor = ($this->loopItSelf === false) ? Container::withClass($class)->initialize()->getReflectionConstructor() : null;

            // building up the library
            $injector[$key] = (null !== $constructor) ? new $class(...$this->asItSelfIsEnabled()->getInjectedClass($constructor)) : new $class();
        }

        return $injector;
    }
}
