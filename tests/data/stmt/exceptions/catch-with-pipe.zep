namespace Malios;

class Person
{
    private name;
    private age;
    public function __construct(string name, int age)
    {
        var ex;
        try {
            this->setName(name);
            this->setAge(age);
        } catch \LengthException|\LogicException, ex{
            echo "Invalid parameters";
            throw ex;
        };
    }
    public function setName(string name)
    {
        if strlen(name) < 2 {
            throw new \LengthException("Name must be at least 2 symbols long");
        };
        let this->name = name;
    }
    public function setAge(int age)
    {
        if age < 0 {
            throw new \LogicException("Age cannot be a negative number");
        };
        let this->age = age;
    }
}
