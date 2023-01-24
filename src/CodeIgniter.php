<?php

namespace Conquer\Container;

use CodeIgniter\CodeIgniter as BaseCodeIgniter;
use CodeIgniter\Controller;
use Config\Services;

/**
 * This class is the core of the framework, and will analyse the
 * request, route it to a controller, and send back the response.
 * Of course, there are variations to that flow, but this is the brains.
 */
class CodeIgniter extends BaseCodeIgniter
{
    /**
     * Instantiates the controller class.
     *
     * @return Controller
     */
    protected function createController()
    {
        assert(is_string($this->controller));

        $container = Container::withController($this->controller)->initialize();

        $class = $container->build();

        $class->initController($this->request, $this->response, Services::logger());

        $this->benchmark->stop('controller_constructor');

        return $class;
    }
}
