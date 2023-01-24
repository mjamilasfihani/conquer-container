<?php

namespace Conquer\Container\Libraries;

use Conquer\Container\Libraries\Traits\WithClassName;
use Conquer\Container\Libraries\Traits\WithInjectedClass;
use Conquer\Container\Traits\WithReflectionClass;
use Conquer\Container\Traits\WithReflectionConstructor;

abstract class BaseContainer
{
    use WithClassName;
    use WithInjectedClass;
    use WithReflectionClass;
    use WithReflectionConstructor;
}
