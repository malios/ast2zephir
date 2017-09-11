<?php

namespace Malios;

class Person
{
    private $name = 'John Doe';
    private $age = 21;

    public function get(string $propName)
    {
        return $this->{$propName};
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}
