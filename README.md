# CodeIgniter 4 Container
Containerized Dependency Injection for CodeIgniter 4 Controller.

Warning! This library crack the core point of CodeIgniter 4, consider to use it at your own risk!

[![](https://github.com/mjamilasfihani/conquer-container/workflows/PHPUnit/badge.svg)](https://github.com/mjamilasfihani/conquer-container/actions/workflows/phpunit.yml)
[![](https://github.com/mjamilasfihani/conquer-container/workflows/PHPStan/badge.svg)](https://github.com/mjamilasfihani/conquer-container/actions/workflows/phpstan.yml)
[![](https://github.com/mjamilasfihani/conquer-container/workflows/Deptrac/badge.svg)](https://github.com/mjamilasfihani/conquer-container/actions/workflows/deptrac.yml)
[![Coverage Status](https://coveralls.io/repos/github/mjamilasfihani/conquer-container/badge.svg?branch=develop)](https://coveralls.io/github/mjamilasfihani/conquer-container?branch=develop)

## Prerequisites
Usage of Conquer\Container requires the following:

- A [CodeIgniter 4.2.0+](https://github.com/codeigniter4/CodeIgniter4/) based project
- [Composer](https://getcomposer.org/) for package management
- PHP 7.4+

## Installation
Use the package manager [composer](https://getcomposer.org/) to install.

```bash
composer require mjamilasfihani/conquer-container
```

## Usage
Let's say you have `app/Libraries/ExampleLibrary.php` file, and you want to load in `__construct()` function

in your controller without initializing it manually. Than this library is yours.

Can I imagine your controller? Thank you :
```php
<?php

namespace App\Controllers;

use App\Controller\BaseController;
use App\Libraries\ExampleLibrary;

class Home extends BaseController
{
    /**
     * @var \App\Libraries\ExampleLibrary
     */
    protected ExampleLibrary $exampleLibrary;

    // This is your old constructor isn't?
    //
    // /**
    //  * Constructor
    //  */
    // public function __construct()
    // {
    //     $this->exampleLibrary = new ExampleLibrary();
    // }

    /**
     * This will be your new Constructor
     *
     * @param \App\Libraries\ExampleLibrary $exampleLibrary
     */
    public function __construct(ExampleLibrary $exampleLibrary)
    {
        $this->exampleLibrary = $exampleLibrary;
    };
    
    /**
     * Display Homepage
     *
     * @return string
     */
    public function index(): string
    {
        // even it has equal result, depend how like you call your library :)
        $this->exampleLibrary;

        return view('welcome_message');
    }
}

```

Remember one thing! Doing container like this is not officially supported by CodeIgniter 4,

since it has different structure do not judge me if you got an error for calling

the CodeIgniter 4 library use this method. (Do It By Your Own Risk)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
