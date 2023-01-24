<?php

namespace Conquer\Container\Traits\Configuration;

use ReflectionClass;

trait WithReflectionConstructorConfiguration
{
    protected function setReflectionConstructor(ReflectionClass $reflectionClass)
    {
        $this->reflectionConstructor = $reflectionClass->getConstructor();

        return $this;
    }
}
