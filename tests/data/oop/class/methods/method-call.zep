namespace Malios;

class Person
{
    public function getReadyToWork(string dayOfWeek)
    {
        var day;
        let day = ucfirst(strtolower(dayOfWeek));
        this->wakeUp(day);
        this->brushTeeth();
        this->drinkCoffee();
        this->say("what a beautiful " . day);
        this->say("ready!");
    }
    private function wakeUp(string dayOfWeek)
    {
        if (dayOfWeek === "Saturday") || (dayOfWeek === "Sunday") {
            exit("no!");
        };
        this->say("woke up");
    }
    private function brushTeeth()
    {
        this->say("brushed teeth");
    }
    private function drinkCoffee()
    {
        var coffee;
        let coffee = this->makeCoffee();
        this->say("drinking " . coffee);
    }
    private function makeCoffee() -> string
    {
        this->say("made coffee");
        return "espresso";
    }
    private function say(string str)
    {
        echo str . PHP_EOL;
    }
}
