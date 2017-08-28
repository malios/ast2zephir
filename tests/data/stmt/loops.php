<?php declare(strict_types=1);

namespace Malios;

class Loop
{
    public function printThese(array $numbers)
    {
        foreach ($numbers as $index => $number) {
            echo $number . PHP_EOL;
        }
    }
}
