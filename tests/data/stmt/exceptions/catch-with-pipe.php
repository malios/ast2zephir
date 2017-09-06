<?php

class Person
{
    private $name, $age;

    public function __construct(string $name, int $age)
    {
        try {
            $this->setName($name);
            $this->setAge($age);
        } catch (\LengthException|\LogicException $ex) {
            echo "Invalid parameters";
            throw $ex;
        }
    }

    public function setName(string $name)
    {
        if (strlen($name) < 2) {
            throw new \LengthException('Name must be at least 2 symbols long');
        }

        $this->name = $name;
    }

    public function setAge(int $age)
    {
        if ($age < 0) {
            throw new \LogicException('Age cannot be a negative number');
        }

        $this->age = $age;
    }
}
