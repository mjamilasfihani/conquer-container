<?php

namespace Tests\Support\Libraries;

use CodeIgniter\HTTP\Response;

class ExampleLibrary
{
    public function exampleReturn(): int
    {
        return Response::HTTP_OK;
    }
}
