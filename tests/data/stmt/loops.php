<?php declare(strict_types=1);

namespace Malios;

class Loop
{
    public static function printThese(array $numbers)
    {
        foreach ($numbers as $index => $number) {
            echo 'numbers[' . $index . '] = '. $number . PHP_EOL;
        }
    }

    public static function printOneToTen()
    {
        foreach (range(1, 10) as $number) {
            print $number;
            print PHP_EOL;
        }
    }

    public function findMin(array $numbers): float
    {
        $min = 0;
        for ($i = 0; $i < count($numbers); $i++) {
            if ($numbers[$i] < $min) {
                $min = $numbers[$i];
            }
        }

        return $min;
    }

    public function veryEfficientPrint()
    {
        for ($i=0, $k=10; $i<=10, $k > 1; $i++, $k--) {
            if ($i == $k) {
                continue;
            }
            echo "Var " . $i . " is " . $k . PHP_EOL;
        }
    }

    public function whileTrue()
    {
        $end = 42;
        $counter = 0;
        while (true ^ false) {
            if ($counter === $end) {
                break;
            }

            echo "count is " . $counter . PHP_EOL;
            $counter++;
        }
    }

    public function doThisWhile()
    {
        $a = 2;
        $prev = $a;
        do {
            echo 'a is: ' . $a . PHP_EOL;
            $a = $a + $prev;
            $prev = $a;
        } while ($a < 1025);
    }
}
