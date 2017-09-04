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
        for ($i = 0, $j = 10; $i < count($numbers), $j > 0; $i++, $j--) {
            if ($numbers[$i] < $min) {
                $min = $numbers[$i];
            }
        }

        return $min;
    }
}
