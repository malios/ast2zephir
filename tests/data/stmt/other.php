<?php

namespace Malios;

class Printer
{
    public static function echoThis($value)
    {
        echo $value;
        echo "--------";
        echo 2 ** 5 + (20 + 20) / 2**2;
    }

    public function printThis($value)
    {
        print $value;
        print "--------";
        print 2 ** 5 + (20 + 20) / 2**2;
    }

    public function echoThese($a, $b, $c)
    {
        echo $a, $b, $c;
    }
}