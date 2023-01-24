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

    private function __construct(string $classname)
    {
        $this->class = $classname;
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

        return ($constructor !== null) ? new $this->class(...$this->getInjectedClass($constructor)) : new $this->class();
    }

    private function getInjectedClass(ReflectionMethod $constructor): array
    {
        $injector       = [];
        $child_injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            $injected_class = $this->getInjectedClassName($param);

            $child = self::withController($injected_class)->initialize()->getReflectionConstructor();

            if (null !== $child) {
                foreach ($child->getParameters() as $keyChild => $paramChild) {
                    $child_injected_class = $this->getInjectedClassName($paramChild);

                    $child_injector[$keyChild] = new $child_injected_class();
                }
            }

            $injector[$key] = (null !== $child) ? new $injected_class(...$child_injector) : new $injected_class();
        }

        return $injector;
    }

    private function getInjectedClassName(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }
}
