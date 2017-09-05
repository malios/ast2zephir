namespace Malios;

class FooFactory
{
    private container = null;
    public static function createBar()
    {
        return new Bar();
    }
    public static function createPerson() -> <Person>
    {
        var person, name;
        let name = "Jon Doe";
        let person = new Person(name);
        echo "Created " . name;
        return person;
    }
    public function createThis(string serviceName)
    {
        var obj;
        let obj = new {serviceName}(this->container);
        return obj;
    }
}
