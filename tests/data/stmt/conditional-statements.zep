namespace Malios;

class MegaHelper
{
    public function isGreater(a, b) -> bool
    {
        if a > b {
            return true;
        };
        return false;
    }
    public function isLessThan(a, b) -> bool
    {
        if a < b {
            return true;
        } else {
            return false;
        };
    }
    public function isEven(int num) -> bool
    {
        if num === 0 {
            return false;
        } elseif (num % 2) === 0 {
            return true;
        } else {
            return false;
        };
    }
    public function isNot(cond)
    {
        return !cond;
    }
    public function getDayOfWeek(int num) -> string
    {
        var day;
        if num === 1 {
            let day = "Mon";
        } elseif num === 2 {
            let day = "Tue";
        } elseif num === 3 {
            let day = "Wed";
        } elseif num === 4 {
            let day = "Thu";
        } elseif num === 5 {
            let day = "Fri";
        } elseif num === 6 {
            let day = "Sat";
        } elseif num === 7 {
            let day = "Sun";
        } else {
            let day = "Invalid";
        };
        return day;
    }
    public function checkIsEvenInACoolWay(int num)
    {
        return (num % 2) === 0 ? true : false;
    }
    public function multipleTernaryOperationsAreForCoolKids(int num)
    {
        return num === 0 ? false : (num % 2) === 0 ? true : false;
    }
    public function ternaryShort(num = null)
    {
        return num ?: 0;
    }
    public function getMood(string dayOfWeek) -> string
    {
        var mood;
        switch dayOfWeek {
            case "Monday":
                let mood = "I don't wanna talk about it!";
                break;
            case "Tuesday":
            case "Wednesday":
                let mood = "At least it's not Monday.";
                break;
            case "Thursday":
                let mood = "Is it Friday yet?";
                break;
            case "Friday":
                let mood = "It's almost over!";
                break;
            case "Saturday":
            case "Sunday":
                let mood = "Party!!!";
                break;
            default:
                let mood = "Wat?";
                break;
        };
        return mood;
    }
}
