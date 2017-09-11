<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Common;

use Malios\Ast2Zephir\Generator\Finder;
use PhpParser\Node\Param;

trait Parameters
{
    use NodeToCode;

    /**
     * Get function or method parameters including the types
     *
     * @param Finder $finder
     * @param Param[] ...$params
     * @return array
     */
    public function getParameters(Finder $finder, Param ...$params): array
    {
        $paramsArray = array_map(function (Param $param) use ($finder) {
            return $this->nodeToCode($param, $finder);
        }, $params);

        return $paramsArray;
    }
}
