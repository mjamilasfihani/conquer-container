<?php

namespace Tests\Support\Controllers;

use App\Controllers\BaseController;
use Tests\Support\Libraries\ExampleLibrary;

class ExampleController extends BaseController
{
    protected $exampleLibrary;

    public function __construct(ExampleLibrary $exampleLibrary)
    {
        $this->exampleLibrary = $exampleLibrary;
    }

    public function index(): int
    {
        return $this->exampleLibrary->exampleReturn();
    }
}
