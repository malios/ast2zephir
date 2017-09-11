<?php declare(strict_types=1);

namespace Malios;

use Psr\Log\LoggerInterface;

class Test
{
    public function sum(int $a, int $b, bool $round = false): int
    {
        return $a + $b;
    }

    public function merge(array $first, array $second = [])
    {
        return $first + $second;
    }

    public function round(float $a)
    {
        return 42;
    }

    public function concat(string $first, string $second = ""): string
    {
        return $first . $second;
    }

    public function setLogger(LoggerInterface $logger): self
    {

    }

    public function getLogger(): \Psr\Log\LoggerInterface
    {

    }

    public function noType($val)
    {

    }
}
