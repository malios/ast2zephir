<?php

namespace Malios;

final class BinaryOp
{
    /**
     * @param float $a
     * @param float $b
     * @return float
     */
    public function sum(float $a, float $b): float
    {
        $sum = $a + $b;
        return $sum;
    }

    public function subtract(float $a, $b)
    {
        return $a - $b;
    }

    public function multiply($a, float $b): float
    {
        return $a * $b;
    }

    public function divide($a, $b)
    {
        return $a / $b;
    }

    public function equal($a, $b): bool
    {
        return $a == $b;
    }

    public function notEqual($a, $b) : bool
    {
        return $a != $b;
    }

    public function identical($a, $b) : bool
    {
        return $a === $b;
    }

    public function notIdentical($a, $b) : bool
    {
        return $a !== $b;
    }

    public function concat(string $a, string $b) : string
    {
        return $a . $b;
    }

    public function greater($a, $b) : bool
    {
        return $a > $b;
    }

    public function smaller($a, $b) : bool
    {
        return $a < $b;
    }

    public function greaterOrEqual($a, $b) : bool
    {
        return $a >= $b;
    }

    public function smallerOrEqual($a, $b) : bool
    {
        return $a <= $b;
    }

    public function pow(float $a, float $b)
    {
        return $a ** $b;
    }

    public function isEven(int $a, int $b)
    {
        return ($a % $b) == 0;
    }

    public function bitwiseAnd($a, $b)
    {
        return $a & $b;
    }

    public function bitwiseOr($a, $b)
    {
        return $a | $b;
    }

    public function bitwiseXOR($a, $b)
    {
        return $a ^ $b;
    }

    public function booleanAnd(bool $a, bool $b): bool
    {
        return $a && $b;
    }

    public function booleanOR(bool $a, bool $b): bool
    {
        return $a || $b;
    }

    public function logicalAnd(bool $a, bool $b): bool
    {
        return $a and $b;
    }

    public function logicalOr(bool $a, bool $b): bool
    {
        return $a or $b;
    }

    public function logicalXOR(bool $a, bool $b)
    {
        return $a xor $b;
    }

    public function shiftLeft($a, $b)
    {
        return $a << $b;
    }

    public function shiftRight($a, $b)
    {
        return $b >> $a;
    }
}
