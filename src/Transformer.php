<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

use Malios\Ast2Zephir\Generator\Finder;
use PhpParser\Node;

class Transformer
{
    private $finder;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function transform(Node ...$nodes): string
    {
        $code = '';
        foreach ($nodes as $index => $node) {
            $generator = $this->finder->find($node->getType());
            $chunk = $generator->generateCode($node);
            $code .= $chunk;
            if (!(empty($chunk) || $index === (count($nodes) - 1))) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }
}
