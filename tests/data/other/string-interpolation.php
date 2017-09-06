<?php

namespace Malios;

class Person
{
    public $name = 'John';

    public function sayHello(Person $person)
    {
        $question = $this->getQuestion();
        echo "Hi {$person->getName()}! My name is {$this->name}. \n $question";
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuestion(): string
    {
        $questions = [
            'Where\'r you from?',
            'What do you do for living?',
            'Would you like to drink some coffee?',
        ];

        return $questions[array_rand($questions)];
    }
}
