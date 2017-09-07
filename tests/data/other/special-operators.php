<?php

namespace Malios;

class Test
{
    private $someVal = 'default';

    public function checkIsset(array $arr, string $key): bool
    {
        return isset($arr[$key]);
    }

    public function checkKeysSet(array $arr): bool
    {
        return isset($arr['foo'], $arr['bar']);
    }

    public function isEmpty($stuff): bool
    {
        return empty($stuff);
    }

    public function isTypeOf(object $obj, string $type): bool
    {
        return gettype($obj) == $type;
    }

    public function isSameInstance(object $obj): bool
    {
        return $obj instanceof $this;
    }

    public function unsetEverything()
    {
        $a = 4;
        unset($a);

        unset($this->someVal);

        $arr = ['foo' => 'bar'];

        unset($arr['foo']);

        $b = 'asd';
        $arr2 = ['baz' => 'qux'];
        unset($b, $arr2['baz']);
    }

    public function evalSomeStuff()
    {
        eval("echo 'hello world'");
    }
}
