<?php declare(strict_types=1);

namespace Malios;

class MegaHelper
{
    public function isGreater($a, $b): bool
    {
        if ($a > $b) {
            return true;
        }

        return false;
    }

    public function isLessThan($a, $b): bool
    {
        if ($a < $b) {
            return true;
        } else {
            return false;
        }
    }

    public function isEven(int $num): bool
    {
       if ($num === 0) {
           return false;
       } elseif ($num % 2 === 0) {
           return true;
       } else {
           return false;
       }
    }

    public function isNot($cond)
    {
        return !$cond;
    }

    public function getDayOfWeek(int $num): string
    {
        if ($num === 1) {
            $day = 'Mon';
        } elseif ($num === 2) {
            $day = 'Tue';
        } elseif ($num === 3) {
            $day  = 'Wed';
        } elseif ($num === 4) {
            $day = 'Thu';
        } elseif ($num === 5) {
            $day = 'Fri';
        } elseif ($num === 6) {
            $day = 'Sat';
        } elseif ($num === 7) {
            $day = 'Sun';
        } else {
            $day = 'Invalid';
        }

        return $day;
    }

    public function checkIsEvenInACoolWay(int $num)
    {
        return $num % 2 === 0 ? true : false;
    }

    public function multipleTernaryOperationsAreForCoolKids(int $num)
    {
        return $num === 0 ? false : $num % 2 === 0 ? true : false;
    }

    public function ternaryShort($num = null)
    {
        return $num ?: 0;
    }

    public function getMood(string $dayOfWeek): string
    {
        switch ($dayOfWeek) {
            case 'Monday':
                $mood = 'I don\'t wanna talk about it!';
                break;
            case 'Tuesday':
            case 'Wednesday':
                $mood = 'At least it\'s not Monday.';
                break;
            case 'Thursday':
                $mood = 'Is it Friday yet?';
                break;
            case 'Friday':
                $mood = 'It\'s almost over!';
                break;
            case 'Saturday':
            case 'Sunday':
                $mood = 'Party!!!';
                break;
            default:
                $mood = 'Wat?';
                break;
        }

        return $mood;
    }
}
