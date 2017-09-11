<?php

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Exception\GeneratorNotFoundException;
use Malios\Ast2Zephir\Generator\Expr\Array_;
use Malios\Ast2Zephir\Generator\Expr\ArrayDimFetch;
use Malios\Ast2Zephir\Generator\Expr\ArrayItem;
use Malios\Ast2Zephir\Generator\Expr\Assign;
use Malios\Ast2Zephir\Generator\Expr\AssignOp;
use Malios\Ast2Zephir\Generator\Expr\BinaryOp;
use Malios\Ast2Zephir\Generator\Expr\BooleanNot;
use Malios\Ast2Zephir\Generator\Expr\Cast;
use Malios\Ast2Zephir\Generator\Expr\ClassConstFetch;
use Malios\Ast2Zephir\Generator\Expr\Clone_;
use Malios\Ast2Zephir\Generator\Expr\ConstFetch;
use Malios\Ast2Zephir\Generator\Expr\Empty_;
use Malios\Ast2Zephir\Generator\Expr\Eval_;
use Malios\Ast2Zephir\Generator\Expr\Exit_;
use Malios\Ast2Zephir\Generator\Expr\FuncCall;
use Malios\Ast2Zephir\Generator\Expr\Instanceof_;
use Malios\Ast2Zephir\Generator\Expr\Isset_;
use Malios\Ast2Zephir\Generator\Expr\MethodCall;
use Malios\Ast2Zephir\Generator\Expr\New_;
use Malios\Ast2Zephir\Generator\Expr\PostDec;
use Malios\Ast2Zephir\Generator\Expr\PostInc;
use Malios\Ast2Zephir\Generator\Expr\Print_;
use Malios\Ast2Zephir\Generator\Expr\PropertyFetch;
use Malios\Ast2Zephir\Generator\Expr\StaticCall;
use Malios\Ast2Zephir\Generator\Expr\StaticPropertyFetch;
use Malios\Ast2Zephir\Generator\Expr\Ternary;
use Malios\Ast2Zephir\Generator\Expr\Variable;
use Malios\Ast2Zephir\Generator\Scalar\DNumber;
use Malios\Ast2Zephir\Generator\Scalar\Encapsed;
use Malios\Ast2Zephir\Generator\Scalar\EncapsedStringPart;
use Malios\Ast2Zephir\Generator\Scalar\LNumber;
use Malios\Ast2Zephir\Generator\Scalar\String_;
use Malios\Ast2Zephir\Generator\Stmt\Break_;
use Malios\Ast2Zephir\Generator\Stmt\Catch_;
use Malios\Ast2Zephir\Generator\Stmt\Class_;
use Malios\Ast2Zephir\Generator\Stmt\ClassConst;
use Malios\Ast2Zephir\Generator\Stmt\ClassMethod;
use Malios\Ast2Zephir\Generator\Stmt\Continue_;
use Malios\Ast2Zephir\Generator\Stmt\Do_;
use Malios\Ast2Zephir\Generator\Stmt\Echo_;
use Malios\Ast2Zephir\Generator\Stmt\Else_;
use Malios\Ast2Zephir\Generator\Stmt\ElseIf_;
use Malios\Ast2Zephir\Generator\Stmt\For_;
use Malios\Ast2Zephir\Generator\Stmt\Foreach_;
use Malios\Ast2Zephir\Generator\Stmt\GroupUse;
use Malios\Ast2Zephir\Generator\Stmt\If_;
use Malios\Ast2Zephir\Generator\Stmt\InlineHTML;
use Malios\Ast2Zephir\Generator\Stmt\Interface_;
use Malios\Ast2Zephir\Generator\Stmt\Namespace_;
use Malios\Ast2Zephir\Generator\Stmt\Property;
use Malios\Ast2Zephir\Generator\Stmt\PropertyProperty;
use Malios\Ast2Zephir\Generator\Stmt\Return_;
use Malios\Ast2Zephir\Generator\Stmt\Switch_;
use Malios\Ast2Zephir\Generator\Stmt\Throw_;
use Malios\Ast2Zephir\Generator\Stmt\TryCatch;
use Malios\Ast2Zephir\Generator\Stmt\Unset_;
use Malios\Ast2Zephir\Generator\Stmt\Use_;
use Malios\Ast2Zephir\Generator\Stmt\UseUse;
use Malios\Ast2Zephir\Generator\Stmt\While_;
use Malios\Ast2Zephir\Logger\EchoLogger;
use Malios\Ast2Zephir\Name as NameEnum;
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
        Expr::CLASS_CONST_FETCH => ClassConstFetch::class,
        Expr::PROPERTY_FETCH => PropertyFetch::class,
        Expr::STATIC_PROPERTY_FETCH => StaticPropertyFetch::class,
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
        Expr::ASSIGN_OP_CONCAT => AssignOp::class,
        Expr::ASSIGN_OP_PLUS => AssignOp::class,
        Expr::ASSIGN_OP_MINUS => AssignOp::class,
        Expr::ASSIGN_OP_DIV => AssignOp::class,
        Expr::ASSIGN_OP_MUL => AssignOp::class,
        Expr::ASSIGN_OP_BITWISE_AND => AssignOp::class,
        Expr::ASSIGN_OP_BITWISE_OR => AssignOp::class,
        Expr::ASSIGN_OP_BITWISE_XOR => AssignOp::class,
        Expr::ASSIGN_OP_BITWISE_MOD => AssignOp::class,
        Expr::ASSIGN_OP_SHIFT_LEFT => AssignOp::class,
        Expr::ASSIGN_OP_SHIFT_RIGHT => AssignOp::class,
        Expr::VARIABLE => Variable::class,
        Expr::TERNARY => Ternary::class,
        Expr::PRINT => Print_::class,
        Expr::FUNC_CALL => FuncCall::class,
        Expr::METHOD_CALL => MethodCall::class,
        Expr::STATIC_CALL => StaticCall::class,
        Expr::ARRAY_DIM_FETCH => ArrayDimFetch::class,
        Expr::POST_INC => PostInc::class,
        Expr::POST_DEC => PostDec::class,
        Expr::EXIT => Exit_::class,
        Expr::NEW => New_::class,
        Expr::ISSET => Isset_::class,
        Expr::EMPTY => Empty_::class,
        Expr::INSTANCEOF => Instanceof_::class,
        Expr::EVAL => Eval_::class,
        Expr::BOOLEAN_NOT => BooleanNot::class,
        Expr::CAST_BOOL => Cast::class,
        Expr::CAST_INT => Cast::class,
        Expr::CAST_STRING => Cast::class,
        Expr::CAST_OBJECT => Cast::class,
        Expr::CAST_DOUBLE => Cast::class,
        Expr::CAST_ARRAY => Cast::class,
        Expr::CAST_UNSET => Cast::class,
        Expr::CLONE => Clone_::class,
        Scalar::LNUMBER => LNumber::class,
        Scalar::DNUMBER => DNumber::class,
        Scalar::STRING => String_::class,
        Scalar::ENCAPSED => Encapsed::class,
        Scalar::ENCAPSED_STRING_PART => EncapsedStringPart::class,
        Stmt::NAMESPACE => Namespace_::class,
        Stmt::USE => Use_::class,
        Stmt::USE_USE => UseUse::class,
        Stmt::GROUP_USE => GroupUse::class,
        Stmt::DECLARE => Noop::class,
        Stmt::NOP => Noop::class,
        Stmt::CLASS_ => Class_::class,
        Stmt::INTERFACE => Interface_::class,
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
        Stmt::CONTINUE => Continue_::class,
        Stmt::ECHO => Echo_::class,
        Stmt::FOREACH => Foreach_::class,
        Stmt::FOR => For_::class,
        Stmt::WHILE => While_::class,
        Stmt::DO => Do_::class,
        Stmt::THROW => Throw_::class,
        Stmt::CATCH => Catch_::class,
        Stmt::TRY_CATCH => TryCatch::class,
        Stmt::INLINE_HTML => InlineHTML::class,
        Stmt::UNSET => Unset_::class,
        NameEnum::NAME => Name::class,
        NameEnum::FULLY_QUALIFIED => FullyQualified::class,
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
