<?php

namespace Conquer\Container\Traits\Helper;

use ReflectionMethod;

trait WithReflectionConstructorHelper
{
    protected function getReflectionConstructor(): ?ReflectionMethod
    {
        return $this->reflectionConstructor;
    }
}
