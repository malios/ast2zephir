namespace Malios;

class Loop
{
    public static function printThese(array numbers)
    {
        var index, number;
        for index, number in numbers {
            echo "numbers[" . index . "] = " . number . PHP_EOL;
        };
    }
    public static function printOneToTen()
    {
        var number;
        for number in range(1, 10) {
            echo number;
            echo PHP_EOL;
        };
    }
    public function findMin(array numbers) -> float
    {
        var min;
        let min = 0;
        var i;
        let i = 0;
        while(i < count(numbers)) {
            if numbers[i] < min {
                let min = numbers[i];
            };
            let i++;
        };
        return min;
    }
    public function veryEfficientPrint()
    {
        var i, k;
        let i = 0;
        let k = 10;
        while(i <= 10 && k > 1) {
            if i == k {
                continue;
            };
            echo "Var " . i . " is " . k . PHP_EOL;
            let i++;
            let k--;
        };
    }
    public function whileTrue()
    {
        var end, counter;
        let end = 42;
        let counter = 0;
        while(true ^ false) {
            if counter === end {
                break;
            };
            echo "count is " . counter . PHP_EOL;
            let counter++;
        };
    }
    public function doThisWhile()
    {
        var a, prev;
        let a = 2;
        let prev = a;
        do {
            echo "a is: " . a . PHP_EOL;
            let a = a + prev;
            let prev = a;
        } while(a < 1025);
    }
}
