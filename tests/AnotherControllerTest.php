<?php

use CodeIgniter\HTTP\Response;
use CodeIgniter\Test\CIUnitTestCase;
use Conquer\Container\Test\ControllerTestTrait;
use Tests\Support\Controllers\AnotherExampleController;

/**
 * @internal
 */
final class AnotherControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    public function testFromExampleController()
    {
        $result = $this->withUri('http://example.com/another-test')->controller(AnotherExampleController::class)->execute('index');

        $result->assertIsInt(Response::HTTP_OK);
    }
}
