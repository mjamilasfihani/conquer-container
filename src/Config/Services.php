<?php

namespace Conquer\Container\Config;

use CodeIgniter\Config\Services as BaseService;
use Config\App;
use Conquer\Container\CodeIgniter;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This is used in place of a Dependency Injection container primarily
 * due to its simplicity, which allows a better long-term maintenance
 * of the applications built on top of CodeIgniter. A bonus side-effect
 * is that IDEs are able to determine what class you are calling
 * whereas with DI Containers there usually isn't a way for them to do this.
 *
 * @see http://blog.ircmaxell.com/2015/11/simple-easy-risk-and-change.html
 * @see http://www.infoq.com/presentations/Simple-Made-Easy
 */
class Services extends BaseService
{
    /**
     * CodeIgniter, the core of the framework.
     *
     * @return CodeIgniter
     */
    public static function codeigniter(?App $config = null, bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('codeigniter', $config);
        }

        $config ??= config('App');

        return new CodeIgniter($config);
    }
}
