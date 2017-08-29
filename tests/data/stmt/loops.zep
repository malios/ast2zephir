namespace Malios;

class Loop
{
    public function printThese(array numbers)
    {
        var index, number;
        for index, number in numbers {
            echo "numbers[" . index . "] = " . number . PHP_EOL;
        };
    }
}
