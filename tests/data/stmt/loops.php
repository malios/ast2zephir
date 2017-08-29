<?php declare(strict_types=1);

namespace Malios;

class Loop
{
    public function printThese(array $numbers)
    {
        foreach ($numbers as $index => $number) {
            echo 'numbers[' . $index . '] = '. $number . PHP_EOL;
        }
    }

/*    public function printRange(int $start, int $end, array $additional = []) {
        foreach (range($start, $end) + $additional as $number) {
            print $number;
        }
    }*/
}
