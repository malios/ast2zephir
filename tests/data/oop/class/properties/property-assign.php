<?php

namespace Malios;

class Person
{
    private $name = 'John Doe';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }
}