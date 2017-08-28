<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

trait ParseStatements
{
    /**
     * Generic method to parse array of statements.
     * e.g. content of method, if block, else block etc.
     *
     * @param Node[] ...$stmts
     * @param Finder $finder
     * @return string
     */
    private function parseStatements(Finder $finder, Node ...$stmts): string
    {
        $code = '';
        $last = count($stmts) - 1;
        foreach ($stmts as $index => $stmt) {
            if ($stmt->getType() === Stmt::NOP) {
                continue;
            }

            $generator = $finder->find($stmt->getType());
            $code .= $generator->generateCode($stmt) . ';';
            if ($index !== $last) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }
}
