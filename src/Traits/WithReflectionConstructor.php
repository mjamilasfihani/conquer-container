<?php

namespace Conquer\Container\Traits;

use Conquer\Container\Traits\Configuration\WithReflectionConstructorConfiguration;
use Conquer\Container\Traits\Helper\WithReflectionConstructorHelper;
use ReflectionMethod;

trait WithReflectionConstructor
{
    use WithReflectionConstructorConfiguration;
    use WithReflectionConstructorHelper;

    private ?ReflectionMethod $reflectionConstructor = null;
}
