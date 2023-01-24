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

    private function __construct(string $class)
    {
        $this->class = $class;
    }

    public static function withClass(string $name): self
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
        $class = $this->getClass();

        $constructor = $this->getReflectionConstructor();

        return ($constructor !== null) ? new $class(...self::getInjectedClass($constructor, false)) : new $class();
    }

    private static function getInjectedClass(ReflectionMethod $constructor, bool $calling_itself = false): array
    {
        $injector = [];

        foreach ($constructor->getParameters() as $key => $param) {
            // initialize the injected class name
            $class = self::getInjectedClassName($param);

            // re-define the constructor to support child injection
            $constructor = ($calling_itself === false) ? self::withClass($class)->initialize()->getReflectionConstructor() : null;

            // building up the library
            $injector[$key] = (null !== $constructor) ? new $class(...self::getInjectedClass($constructor, true)) : new $class();
        }

        return $injector;
    }

    private static function getInjectedClassName(ReflectionParameter $reflectionParameter): string
    {
        return $reflectionParameter->getType()->getName(); // @phpstan-ignore-line
    }

    private function getClass(): string
    {
        return $this->class;
    }
}
