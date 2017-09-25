<?php

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Logger\EchoLogger;
use Malios\Ast2Zephir\Generator\Exception\GeneratorNotFoundException;
use Psr\Log\LoggerInterface;

class Finder
{
    /**
     * Generator mapping for ast nodes
     * @var array
     */
    private $generators = [];

    private $logger;

    public function __construct(array $generators, LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new EchoLogger();
        }

        $this->logger = $logger;
        $this->generators = $generators;
    }

    public function find(string $name) : Generator
    {
        if (isset($this->generators[$name])) {
            /** @var Generator $generator */
            $generator = new $this->generators[$name]($this);
            $generator->setLogger($this->logger);
            return $generator;
        }

        throw new GeneratorNotFoundException(sprintf('Generator for node type %s not found', $name));
    }
}
