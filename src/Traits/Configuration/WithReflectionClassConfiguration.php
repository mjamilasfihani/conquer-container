<?php

namespace Conquer\Container\Traits\Configuration;

use ReflectionClass;

trait WithReflectionClassConfiguration
{
    protected function setReflectionClass(string $class)
    {
        $this->reflectionClass = new ReflectionClass($class);

        return $this;
    }
}
