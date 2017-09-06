namespace Malios;

abstract class Test
{
    const PI = 3.14;
    const EUL = 2.71;
    const FOO = "bar";
    const TEST = [
        "foo": "bar",
        "baz": [
            "qux": 1
        ]
    ];
    public function getTest()
    {
        return self::TEST;
    }
    public function getPI()
    {
        return Test::PI;
    }
}
