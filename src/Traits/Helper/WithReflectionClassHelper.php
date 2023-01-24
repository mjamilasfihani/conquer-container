<?php

namespace Conquer\Container\Traits\Helper;

use ReflectionClass;

trait WithReflectionClassHelper
{
    protected function getReflectionClass(): ReflectionClass
    {
        return $this->reflectionClass;
    }
}
