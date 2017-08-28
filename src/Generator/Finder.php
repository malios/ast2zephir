<?php

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Exception\GeneratorNotFoundException;
use Malios\Ast2Zephir\Generator\Expr\Array_;
use Malios\Ast2Zephir\Generator\Expr\ArrayItem;
use Malios\Ast2Zephir\Generator\Expr\Assign;
use Malios\Ast2Zephir\Generator\Expr\BinaryOp;
use Malios\Ast2Zephir\Generator\Expr\ConstFetch;
use Malios\Ast2Zephir\Generator\Expr\Print_;
use Malios\Ast2Zephir\Generator\Expr\PropertyFetch;
use Malios\Ast2Zephir\Generator\Expr\Ternary;
use Malios\Ast2Zephir\Generator\Expr\Variable;
use Malios\Ast2Zephir\Generator\Scalar\DNumber;
use Malios\Ast2Zephir\Generator\Scalar\LNumber;
use Malios\Ast2Zephir\Generator\Scalar\String_;
use Malios\Ast2Zephir\Generator\Stmt\Break_;
use Malios\Ast2Zephir\Generator\Stmt\Class_;
use Malios\Ast2Zephir\Generator\Stmt\ClassConst;
use Malios\Ast2Zephir\Generator\Stmt\ClassMethod;
use Malios\Ast2Zephir\Generator\Stmt\Echo_;
use Malios\Ast2Zephir\Generator\Stmt\Else_;
use Malios\Ast2Zephir\Generator\Stmt\ElseIf_;
use Malios\Ast2Zephir\Generator\Stmt\Foreach_;
use Malios\Ast2Zephir\Generator\Stmt\GroupUse;
use Malios\Ast2Zephir\Generator\Stmt\If_;
use Malios\Ast2Zephir\Generator\Stmt\Namespace_;
use Malios\Ast2Zephir\Generator\Stmt\Property;
use Malios\Ast2Zephir\Generator\Stmt\PropertyProperty;
use Malios\Ast2Zephir\Generator\Stmt\Return_;
use Malios\Ast2Zephir\Generator\Stmt\Switch_;
use Malios\Ast2Zephir\Generator\Stmt\Use_;
use Malios\Ast2Zephir\Generator\Stmt\UseUse;
use Malios\Ast2Zephir\Logger\EchoLogger;
use Malios\Ast2Zephir\Scalar;
use Malios\Ast2Zephir\Stmt;
use Psr\Log\LoggerInterface;

class Finder
{
    /**
     * Generator mapping for ast nodes
     * @var array
     */
    private $mapping = [
        Expr::ASSIGN => Assign::class,
        Expr::ARRAY => Array_::class,
        Expr::ARRAY_ITEM => ArrayItem::class,
        Expr::CONST_FETCH => ConstFetch::class,
        Expr::PROPERTY_FETCH => PropertyFetch::class,
        Expr::BINARY_OP_PLUS => BinaryOp::class,
        Expr::BINARY_OP_MINUS => BinaryOp::class,
        Expr::BINARY_OP_MULTIPLY => BinaryOp::class,
        Expr::BINARY_OP_DIVIDE => BinaryOp::class,
        Expr::BINARY_OP_EQUAL => BinaryOp::class,
        Expr::BINARY_OP_NOT_EQUAL => BinaryOp::class,
        Expr::BINARY_OP_IDENTICAL => BinaryOp::class,
        Expr::BINARY_OP_NOT_IDENTICAL => BinaryOp::class,
        Expr::BINARY_OP_CONCAT => BinaryOp::class,
        Expr::BINARY_OP_GREATER => BinaryOp::class,
        Expr::BINARY_OP_GREATER_OR_EQUAL => BinaryOp::class,
        Expr::BINARY_OP_SMALLER => BinaryOp::class,
        Expr::BINARY_OP_SMALLER_OR_EQUAL => BinaryOp::class,
        Expr::BINARY_OP_POW => BinaryOp::class,
        Expr::BINARY_OP_MODULUS => BinaryOp::class,
        Expr::BINARY_OP_BITWISE_AND => BinaryOp::class,
        Expr::BINARY_OP_BITWISE_OR => BinaryOp::class,
        Expr::BINARY_OP_BITWISE_XOR => BinaryOp::class,
        Expr::BINARY_OP_BOOLEAN_AND => BinaryOp::class,
        Expr::BINARY_OP_BOOLEAN_OR => BinaryOp::class,
        Expr::BINARY_OP_LOGICAL_AND => BinaryOp::class,
        Expr::BINARY_OP_LOGICAL_OR => BinaryOp::class,
        Expr::BINARY_OP_LOGICAL_XOR => BinaryOp::class,
        Expr::BINARY_OP_SHIFT_LEFT => BinaryOp::class,
        Expr::BINARY_OP_SHIFT_RIGHT => BinaryOp::class,
        Expr::VARIABLE => Variable::class,
        Expr::TERNARY => Ternary::class,
        Expr::PRINT => Print_::class,
        Scalar::LNUMBER => LNumber::class,
        Scalar::DNUMBER => DNumber::class,
        Scalar::STRING => String_::class,
        Stmt::NAMESPACE => Namespace_::class,
        Stmt::USE => Use_::class,
        Stmt::USE_USE => UseUse::class,
        Stmt::GROUP_USE => GroupUse::class,
        Stmt::DECLARE => Noop::class,
        Stmt::NOP => Noop::class,
        Stmt::CLASS_ => Class_::class,
        Stmt::CLASS_METHOD => ClassMethod::class,
        Stmt::CLASS_CONST => ClassConst::class,
        Stmt::PROPERTY => Property::class,
        Stmt::PROPERTY_PROPERTY => PropertyProperty::class,
        Stmt::RETURN => Return_::class,
        Stmt::IF => If_::class,
        Stmt::ELSE => Else_::class,
        Stmt::ELSEIF => ElseIf_::class,
        Stmt::SWITCH => Switch_::class,
        Stmt::BREAK => Break_::class,
        Stmt::ECHO => Echo_::class,
        Stmt::FOREACH => Foreach_::class,
        'Const' => Const_::class,
        'Param' => Param::class,
    ];

    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new EchoLogger();
        }

        $this->logger = $logger;
    }

    public function find(string $name) : Generator
    {
        if (isset($this->mapping[$name])) {
            /** @var Generator $generator */
            $generator = new $this->mapping[$name]($this);
            $generator->setLogger($this->logger);
            return $generator;
        }

        throw new GeneratorNotFoundException(sprintf('Generator for node type %s not found', $name));
    }
}
