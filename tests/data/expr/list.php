<?php declare(strict_types=1);

namespace Test;

class Test
{
    public function listThese(array $words)
    {
        list($a, $b, $c, $d) = $words;
        echo $a . ' ' . $b . ' ' . $c . ' ' . $d;
    }

    public function listSomeStuff()
    {
        list($one, $two) = [1, 2];
        echo "$one $two";
    }

    public function listSum()
    {
        // @todo: zephir compilation fails in this case, but it does not if we assign arrays to variables
        //list($one, $two) = [1, 2] + [2];
        // echo "$one $two";
    }
}
