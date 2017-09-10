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

    public function castThis($value)
    {
        return [
            'bool' => (bool) $value,
            'boolean' => (boolean) $value,
            'int' => (int) $value,
            'integer' => (integer) $value,
            'string' => (string) $value,
            'object' => (object) $value,
            'float' => (float) $value,
            'double' => (double) $value,
            'real' => (real) $value,
            'array' => (array) $value,
            // 'unset' => (unset) $value, // cast to null
        ];
    }
}