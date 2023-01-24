<?php

namespace Tests\Support\Libraries;

class AnotherExampleLibrary
{
    protected ExampleLibrary $exampleLibrary;

    /**
     * Constructor
     */
    public function __construct(ExampleLibrary $exampleLibrary)
    {
        $this->exampleLibrary = $exampleLibrary;
    }

    public function anotherExampleReturn(): int
    {
        return $this->exampleLibrary->exampleReturn();
    }
}
