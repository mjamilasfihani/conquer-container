<?php

namespace Conquer\Container\Traits\Helper;

use ReflectionMethod;

trait WithReflectionConstructorHelper
{
    public function getReflectionConstructor(): ?ReflectionMethod
    {
        return $this->reflectionConstructor;
    }
}
