namespace Malios;

class AssignOp
{
    public function concat(string str) -> string
    {
        var a;
        let a = "foo ";
        let a = a . str;
        return str;
    }
    public function add(int num) -> int
    {
        var a;
        let a = 42;
        let a = a + num;
        return a;
    }
    public function subtract(int num) -> int
    {
        var a;
        let a = 42;
        let a = a - num;
        return a;
    }
    public function div(int num) -> float
    {
        var a;
        let a = 42;
        let a = a / num;
        return a;
    }
    public function multiply(int num) -> int
    {
        var a;
        let a = 42;
        let a = a * num;
        return a;
    }
    public function andOp(int num)
    {
        var a;
        let a = 42;
        let a = a & num;
        return a;
    }
    public function orOp(int num)
    {
        var a;
        let a = 42;
        let a = a | num;
        return a;
    }
    public function xorOp(int num)
    {
        var a;
        let a = 42;
        let a = a ^ num;
        return a;
    }
    public function mod(int num)
    {
        var a;
        let a = 42;
        let a = a % num;
        return a;
    }
    public function shiftLeft(int num)
    {
        var a;
        let a = 42;
        let a = a << num;
        return a;
    }
    public function shiftRight(int num)
    {
        var a;
        let a = 42;
        let a = a >> num;
        return a;
    }
}
