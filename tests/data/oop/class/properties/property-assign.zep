namespace Malios;

class Person
{
    private name = "John Doe";
    public function __construct(string name)
    {
        let this->name = name;
    }
    public function setName(string name)
    {
        let this->name = name;
    }
}
