<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Stmt;

use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\Generator\Common\ParseStatements;
use Malios\Ast2Zephir\Stmt;
use PhpParser\Node;

final class Switch_ extends Generator
{
    use ParseStatements;

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $node->getType() === Stmt::SWITCH;
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param Node\Stmt\Switch_ $node
     */
    protected function doGenerateCode($node): string
    {
        $conditionGenerator = $this->finder->find($node->cond->getType());
        $code = 'switch ' . $conditionGenerator->generateCode($node->cond) . ' {' . PHP_EOL;
        if (!empty($node->cases)) {
            $casesCode = $this->parseCases(...$node->cases);
            $code .= $this->indent($casesCode);
        }

        $code .= PHP_EOL . '}';
        return $code;
    }

    private function parseCases(Node\Stmt\Case_ ...$cases)
    {
        $code = '';
        $last = count($cases) - 1;
        foreach ($cases as $index => $case) {
            if ($case->cond === null) {
                $code .= 'default:' . PHP_EOL;
            } else {
                $conditionGenerator = $this->finder->find($case->cond->getType());
                $code .= 'case ' . $conditionGenerator->generateCode($case->cond) . ':' . PHP_EOL;
            }
            if (empty($case->stmts)) {
                continue;
            }

            $statementsParsed = $this->parseStatements($this->finder, ...$case->stmts);
            $code .= $this->indent($statementsParsed);
            if ($index !== $last) {
                $code .= PHP_EOL;
            }
        }

        return $code;
    }
}
