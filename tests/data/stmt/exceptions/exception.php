<?php

namespace Malios;

use Bar\Qux;

class Exception
{
    public static function notFound()
    {
        throw new \Exception('Test');
    }

    public static function fooBar()
    {
        throw new \Foo\Bar\Exception();
    }

    public static function qux()
    {
        $qux = new Qux();
        throw $qux;
    }
}
