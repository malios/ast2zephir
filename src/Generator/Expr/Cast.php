<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator\Expr;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Common\NodeToCode;
use Malios\Ast2Zephir\Generator\Exception\LogicException;
use Malios\Ast2Zephir\Generator\Generator;
use Malios\Ast2Zephir\NotImplementedException;
use PhpParser\Node;
use PhpParser\Node\Expr\Cast as ExprCast;

final class Cast extends Generator
{
    use NodeToCode;

    private $template = '(%s) %s';

    private $castMapping = [
        Expr::CAST_BOOL => 'bool',
        Expr::CAST_INT => 'int',
        Expr::CAST_STRING => 'string',
        Expr::CAST_OBJECT => 'object',
        Expr::CAST_DOUBLE => 'double',
        Expr::CAST_ARRAY => 'array',
    ];

    /**
     * {@inheritdoc}
     * @see Generator::canGenerateCode()
     */
    protected function canGenerateCode(Node $node): bool
    {
        return $this->isCast($node);
    }

    /**
     * {@inheritdoc}
     * @see Generator::doGenerateCode()
     * @param ExprCast|ExprCast\Unset_ $node
     */
    protected function doGenerateCode($node): string
    {
        $type = $node->getType();
        if ($type === Expr::CAST_UNSET) {
            $code = $this->convertCastUnset($node);
            return $code;
        }

        $cast = $this->castMapping[$type] ?? null;
        if ($cast === null) {
            throw new LogicException(sprintf("Can not convert expression %s", $type));
        }

        $expr = $this->nodeToCode($node->expr, $this->finder);
        $code = sprintf($this->template, $cast, $expr);
        return $code;
    }

    private function isCast(Node $node): bool
    {
        return strpos($node->getType(), Expr::CAST) > -1;
    }

    private function convertCastUnset(Node\Expr\Cast\Unset_ $node): string
    {
        // workaround for cast unset
        if ($node->expr->getType() === Expr::VARIABLE) {
            throw new NotImplementedException();
            // See Expr\Unset_
            // $template = 'let %s = null';
        } else {
            $template = 'unset(%s)';
        }

        $expr = $this->nodeToCode($node->expr, $this->finder);
        $code = sprintf($template, $expr);
        return $code;
    }
}
