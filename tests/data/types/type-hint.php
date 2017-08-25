<?php declare(strict_types=1);

namespace Malios;

use Psr\Log\LoggerInterface;

class Test
{
    public function sum(int $a, int $b, bool $round = false)
    {
        return $a + $b;
    }

    public function round(float $a)
    {
        return 42;
    }

    public function setLogger(LoggerInterface $logger)
    {

    }
}
