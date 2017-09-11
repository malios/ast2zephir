<?php

namespace Malios;

class AssignOp
{
    public function concat(string $str): string
    {
        $a = 'foo ';
        $a .= $str;
        return $str;
    }

    public function add(int $num): int
    {
        $a = 42;
        $a += $num;
        return $a;
    }

    public function subtract(int $num): int
    {
        $a = 42;
        $a -= $num;
        return $a;
    }

    public function div(int $num): float
    {
        $a = 42;
        $a /= $num;
        return $a;
    }

    public function multiply(int $num): int
    {
        $a = 42;
        $a *= $num;
        return $a;
    }

    public function andOp(int $num)
    {
        $a = 42;
        $a &= $num;
        return $a;
    }

    public function orOp(int $num)
    {
        $a = 42;
        $a |= $num;
        return $a;
    }

    public function xorOp(int $num)
    {
        $a = 42;
        $a ^= $num;
        return $a;
    }

    public function mod(int $num)
    {
        $a = 42;
        $a %= $num;
        return $a;
    }

    public function shiftLeft(int $num)
    {
        $a = 42;
        $a <<= $num;
        return $a;
    }

    public function shiftRight(int $num)
    {
        $a = 42;
        $a >>= $num;
        return $a;
    }
}
