<?php

namespace Conquer\Container\Test;

use CodeIgniter\Test\ControllerTestTrait as BaseControllerTestTrait;
use Conquer\Container\Container;
use InvalidArgumentException;

/**
 * Controller Test Trait
 *
 * Provides features that make testing controllers simple and fluent.
 *
 * Example:
 *
 *  $this->withRequest($request)
 *       ->withResponse($response)
 *       ->withURI($uri)
 *       ->withBody($body)
 *       ->controller('App\Controllers\Home')
 *       ->execute('methodName');
 */
trait ControllerTestTrait
{
    use BaseControllerTestTrait;

    /**
     * Loads the specified controller, and generates any needed dependencies.
     *
     * @return $this
     */
    public function controller(string $name)
    {
        if (! class_exists($name)) {
            throw new InvalidArgumentException('Invalid Controller: ' . $name);
        }

        $container = Container::withClass($name)->initialize();

        $this->controller = $container->build();

        $this->controller->initController($this->request, $this->response, $this->logger);

        return $this;
    }
}
