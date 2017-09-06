<?php

namespace Malios;

class Person
{
    private $name;

    public function __construct(string $name)
    {
        try {
            $this->setName($name);
        } catch (\LengthException $lex) {
            echo "invalid name";
            throw $lex;
        } catch (\Exception $ex) {
            echo "unknown error";
            throw $ex;
        }

        $this->setName($name);
    }

    public function setName(string $name)
    {
        if (strlen($name) < 2) {
            throw new \LengthException('Name must be at least 2 symbols long');
        }

        $this->name = $name;
    }
}

