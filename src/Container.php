<?php

namespace Conquer\Container;

use CodeIgniter\Controller;
use Conquer\Container\Libraries\BaseContainer;
use Conquer\Container\Libraries\ContainerInterface;

final class Container extends BaseContainer implements ContainerInterface
{
    /**
     * Constructor
     */
    private function __construct(string $class)
    {
        $this->setClassName($class);
    }

    /**
     * With class
     */
    public static function withClass(string $name): Container
    {
        return new self($name);
    }

    /**
     * Initialize
     *
     * @return $this
     */
    public function initialize()
    {
        $class = $this->getClassName();

        $this->setReflectionClass($class);

        $reflector = $this->getReflectionClass();

        $this->setReflectionConstructor($reflector);

        return $this;
    }

    /**
     * Build
     */
    public function build(): Controller
    {
        $class = $this->getClassName();

        $constructor = $this->getReflectionConstructor();

        return ($constructor !== null) ? new $class(...$this->getInjectedClass($constructor, false)) : new $class();
    }
}
