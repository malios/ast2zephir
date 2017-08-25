namespace Malios;

class Math
{
    private answer = 42;
    public static function sum(float a, float b) -> float
    {
        var result;
        let result = (a + b);
        return result;
    }
    public final function getAnswer()
    {
        return this->answer;
    }
}
