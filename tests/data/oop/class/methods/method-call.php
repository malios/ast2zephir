<?php declare(strict_types=1);

namespace Malios;

class Person
{
    public function getReadyToWork(string $dayOfWeek)
    {
        $this->wakeUp($day = ucfirst(strtolower($dayOfWeek)));
        $this->brushTeeth();
        $this->drinkCoffee();
        $this->say("what a beautiful " . $day);
        $this->say("ready!");
    }

    private function wakeUp(string $dayOfWeek)
    {
        if ($dayOfWeek === 'Saturday' || $dayOfWeek === 'Sunday') {
            die('no!');
        }
        $this->say("woke up");
    }

    private function brushTeeth()
    {
        $this->say("brushed teeth");
    }

    private function drinkCoffee()
    {
        $coffee = $this->makeCoffee();
        $this->say("drinking " . $coffee);
    }

    private function makeCoffee(): string
    {
        $this->say("made coffee");
        return 'espresso';
    }

    private function say(string $str)
    {
        echo $str . PHP_EOL;
    }
}
