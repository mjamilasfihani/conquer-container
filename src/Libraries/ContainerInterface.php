<?php

namespace Conquer\Container\Libraries;

use CodeIgniter\Controller;
use Conquer\Container\Container;

interface ContainerInterface
{
    /**
     * With class
     */
    public static function withClass(string $name): Container;

    /**
     * Initialize
     *
     * @return $this
     */
    public function initialize();

    /**
     * Build
     */
    public function build(): Controller;
}
