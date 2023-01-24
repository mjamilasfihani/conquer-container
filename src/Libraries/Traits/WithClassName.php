<?php

namespace Conquer\Container\Libraries\Traits;

use Conquer\Container\Libraries\Traits\Configuration\WithClassNameConfiguration;
use Conquer\Container\Libraries\Traits\Helper\WithClassNameHelper;

trait WithClassName
{
    use WithClassNameConfiguration;
    use WithClassNameHelper;

    private string $className;
}
