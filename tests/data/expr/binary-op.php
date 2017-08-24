<?php

final class BinaryOp
{
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
        return ($a / $b);
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

    public function pow($a, $b)
    {
        return $a ** $b;
    }
}
