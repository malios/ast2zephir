<?php

namespace Malios;

class FooFactory
{
    private $container = null;

    public static function createBar()
    {
        return new Bar();
    }

    public static function createPerson(): Person
    {
        $person = new Person($name = 'Jon Doe');
        echo 'Created ' . $name;
        return $person;
    }

    public function createThis(string $serviceName)
    {
        $obj = new $serviceName($this->container);
        return $obj;
    }
}
