<?php declare(strict_types=1);

namespace Malios;

use Malios\Di\Container;

class Factory
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(string $serviceName)
    {
        return self::createService($serviceName);
    }

    public static function createService(string $serviceName)
    {
        $service = self::$container->get($lower = strtolower($serviceName));
        echo "creating service " . $lower;
        return $service;
    }

}
