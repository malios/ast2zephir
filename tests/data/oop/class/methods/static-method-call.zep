namespace Malios;

use Malios\Di\Container;

class Factory
{
    private container;
    public function __construct(Container container)
    {
        let this->container = container;
    }
    public function __invoke(string serviceName)
    {
        return self::createService(serviceName);
    }
    public static function createService(string serviceName)
    {
        var service, lower;
        let lower = strtolower(serviceName);
        let service = self::container->get(lower);
        echo "creating service " . lower;
        return service;
    }
}
