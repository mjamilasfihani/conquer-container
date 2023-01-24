<?php

namespace Tests\Support\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use Tests\Support\Libraries\AnotherExampleLibrary;
use Tests\Support\Libraries\ExampleLibrary;

class AnotherExampleController extends BaseController
{
    protected AnotherExampleLibrary $anotherExampleLibrary;
    protected ExampleLibrary $exampleLibrary;

    /**
     * Constructor
     */
    public function __construct(AnotherExampleLibrary $anotherExampleLibrary, ExampleLibrary $exampleLibrary)
    {
        $this->anotherExampleLibrary = $anotherExampleLibrary;
        $this->exampleLibrary        = $exampleLibrary;
    }

    public function index(): int
    {
        return ($this->exampleLibrary->exampleReturn() === $this->anotherExampleLibrary->anotherExampleReturn()) ? Response::HTTP_OK : 0;
    }
}
