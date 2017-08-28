namespace Malios;

class Printer
{
    public static function echoThis(value)
    {
        echo value;
        echo "--------";
        echo (pow(2, 5)) + ((20 + 20) / (pow(2, 2)));
    }
    public function printThis(value)
    {
        echo value;
        echo "--------";
        echo (pow(2, 5)) + ((20 + 20) / (pow(2, 2)));
    }
    public function echoThese(a, b, c)
    {
        echo a, b, c;
    }
}
