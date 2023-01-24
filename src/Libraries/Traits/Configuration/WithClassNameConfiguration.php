<?php

namespace Conquer\Container\Libraries\Traits\Configuration;

trait WithClassNameConfiguration
{
    protected function setClassName(string $class)
    {
        $this->className = $class;

        return $this;
    }
}
