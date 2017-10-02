<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

use Malios\Ast2Zephir\Enum\Stmt;
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
        $this->checkFormat(...$nodes);
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

    private function checkFormat(Node ...$nodes)
    {
        /** @var Node\Stmt\Namespace_ $ns */
        $ns = $nodes[count($nodes) - 1];
        if ($ns->getType() !== Stmt::NAMESPACE) {
            throw new FormatException('Global code should be enclosed in global namespace declaration.');
        }

        $classOrInterfaceCount = 0;
        foreach ($ns->stmts as $stmt) {
            $type = $stmt->getType();
            if ($type === Stmt::CLASS_ || $type === Stmt::INTERFACE) {
                $classOrInterfaceCount++;
            }
        }

        if ($classOrInterfaceCount !== 1) {
            throw new FormatException('All files should have exactly 1 class or interface declaration.');
        }
    }
}
