namespace Malios\Di;

interface Container
{
    public function get(string id);
    public function has(string id) -> bool;
}
