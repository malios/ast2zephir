namespace Malios;

class Test
{
    public function checkIsset(array arr, string key)
    {
        return isset(arr[key]);
    }
    public function checkKeysSet(array arr)
    {
        return isset(arr["foo"]) && isset(arr["bar"]);
    }
}
