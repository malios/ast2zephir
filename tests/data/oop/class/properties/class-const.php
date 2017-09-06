<?php declare(strict_types=1);

namespace Malios;

abstract class Test
{
    public const PI = 3.14, EUL = 2.71;
    private const FOO = 'bar';
    const TEST = [
        "foo" => "bar",
        "baz" => [
            "qux" => 1
        ]
    ];

    public function getTest()
    {
        return self::TEST;
    }

    public function getPI()
    {
        return Test::PI;
    }
}
