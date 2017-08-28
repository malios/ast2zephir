<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Exception\MultipleClassException;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Namespace_ extends Generator
{
    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::NAMESPACE;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Namespace_ $node
     */
    protected function doGenerateCode($node): string
    {
        $code = 'namespace ' . join('\\', $node->name->parts) . ';' . PHP_EOL . PHP_EOL;
        if ($node->stmts !== null) {
            $code .= $this->parseStatements(...$node->stmts);
        }

        return $code;
    }

    private function parseStatements(Node ...$stmts): string
    {
        $code = '';
        $prev = null;
        foreach ($stmts as $stmt) {
            $generator = $this->finder->find($stmt->getType());
            if ($stmt->getType() === Stmt::CLASS_) {
                if ($this->isUse($prev)) {
                    $code .= PHP_EOL;
                }

                if ($prev !== null && $prev->getType() === Stmt::CLASS_) {
                    throw new MultipleClassException('Can\'t have more than 1 class in the same block of code');
                }
            }

            $code .= $generator->generateCode($stmt) . PHP_EOL;
            $prev = $stmt;
        }

        return $code;
    }

    private function isUse(Node $node = null)
    {
        if ($node === null) {
            return false;
        }

        $type = $node->getType();
        return $type === Stmt::USE || $type === Stmt::GROUP_USE;
    }
}
