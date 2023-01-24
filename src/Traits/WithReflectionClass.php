<?php

namespace Conquer\Container\Traits;

use Conquer\Container\Traits\Configuration\WithReflectionClassConfiguration;
use Conquer\Container\Traits\Helper\WithReflectionClassHelper;
use ReflectionClass;

trait WithReflectionClass
{
    use WithReflectionClassConfiguration;
    use WithReflectionClassHelper;

    private ReflectionClass $reflectionClass;
}
