<?php

namespace Malios\Ast2Zephir\Generator;

class FinderFactory
{
    public function create(): Finder
    {
        $generators = require __DIR__ . '/../../config/finder.php';
        return new Finder($generators);
    }
}
