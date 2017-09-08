namespace Malios;

class Test
{
    private someVal = "default";
    public function checkIsset(array arr, string key) -> bool
    {
        return isset(arr[key]);
    }
    public function checkKeysSet(array arr) -> bool
    {
        return isset(arr["foo"]) && isset(arr["bar"]);
    }
    public function isEmpty(stuff) -> bool
    {
        return empty(stuff);
    }
    public function isTypeOf(object obj, string type) -> bool
    {
        return gettype(obj) == type;
    }
    public function isSameInstance(object obj) -> bool
    {
        return obj instanceof this;
    }
    public function unsetEverything()
    {
        var a, arr, b, arr2;
        let a = 4;
        let a = null;
        unset(this->someVal);
        let arr = [
            "foo": "bar"
        ];
        unset(arr["foo"]);
        let b = "asd";
        let arr2 = [
            "baz": "qux"
        ];
        let b = null;
        unset(arr2["baz"]);
    }
    public function evalSomeStuff()
    {
        eval("echo 'hello world'");
    }
}
