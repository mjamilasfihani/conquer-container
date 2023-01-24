<?php

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\CIUnitTestCase;
use Conquer\Container\Test\ControllerTestTrait;
use Tests\Support\Controllers\ExampleController;

/**
 * @internal
 */
final class ControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    public function testFromExampleController()
    {
        $result = $this->withUri('http://example.com/test')->controller(ExampleController::class)->execute('index');

        $result->assertIsInt(Response::HTTP_OK);
    }
}
