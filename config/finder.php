<?php declare(strict_types=1);

use Malios\Ast2Zephir\Enum\Expr;
use Malios\Ast2Zephir\Generator\Const_;
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
use Malios\Ast2Zephir\Generator\Expr\List_;
use Malios\Ast2Zephir\Generator\Expr\MethodCall;
use Malios\Ast2Zephir\Generator\Expr\New_;
use Malios\Ast2Zephir\Generator\Expr\PostDec;
use Malios\Ast2Zephir\Generator\Expr\PostInc;
use Malios\Ast2Zephir\Generator\Expr\Print_;
use Malios\Ast2Zephir\Generator\Expr\PropertyFetch;
use Malios\Ast2Zephir\Generator\Expr\StaticCall;
use Malios\Ast2Zephir\Generator\Expr\StaticPropertyFetch;
use Malios\Ast2Zephir\Generator\Expr\Ternary;
use Malios\Ast2Zephir\Generator\Expr\UnaryMinus;
use Malios\Ast2Zephir\Generator\Expr\UnaryPlus;
use Malios\Ast2Zephir\Generator\Expr\Variable;
use Malios\Ast2Zephir\Generator\FullyQualified;
use Malios\Ast2Zephir\Generator\Name;
use Malios\Ast2Zephir\Generator\Noop;
use Malios\Ast2Zephir\Generator\Param;
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
use Malios\Ast2Zephir\Enum\Name as NameEnum;
use Malios\Ast2Zephir\Enum\Scalar;
use Malios\Ast2Zephir\Enum\Stmt;


return [
    Expr::ASSIGN => Assign::class,
    Expr::ARRAY => Array_::class,
    Expr::ARRAY_ITEM => ArrayItem::class,
    Expr::CONST_FETCH => ConstFetch::class,
    Expr::CLASS_CONST_FETCH => ClassConstFetch::class,
    Expr::PROPERTY_FETCH => PropertyFetch::class,
    Expr::STATIC_PROPERTY_FETCH => StaticPropertyFetch::class,
    Expr\BinaryOp::PLUS => BinaryOp::class,
    Expr\BinaryOp::MINUS => BinaryOp::class,
    Expr\BinaryOp::MULTIPLY => BinaryOp::class,
    Expr\BinaryOp::DIVIDE => BinaryOp::class,
    Expr\BinaryOp::EQUAL => BinaryOp::class,
    Expr\BinaryOp::NOT_EQUAL => BinaryOp::class,
    Expr\BinaryOp::IDENTICAL => BinaryOp::class,
    Expr\BinaryOp::NOT_IDENTICAL => BinaryOp::class,
    Expr\BinaryOp::CONCAT => BinaryOp::class,
    Expr\BinaryOp::GREATER => BinaryOp::class,
    Expr\BinaryOp::GREATER_OR_EQUAL => BinaryOp::class,
    Expr\BinaryOp::SMALLER => BinaryOp::class,
    Expr\BinaryOp::SMALLER_OR_EQUAL => BinaryOp::class,
    Expr\BinaryOp::POW => BinaryOp::class,
    Expr\BinaryOp::MODULUS => BinaryOp::class,
    Expr\BinaryOp::BITWISE_AND => BinaryOp::class,
    Expr\BinaryOp::BITWISE_OR => BinaryOp::class,
    Expr\BinaryOp::BITWISE_XOR => BinaryOp::class,
    Expr\BinaryOp::BOOLEAN_AND => BinaryOp::class,
    Expr\BinaryOp::BOOLEAN_OR => BinaryOp::class,
    Expr\BinaryOp::LOGICAL_AND => BinaryOp::class,
    Expr\BinaryOp::LOGICAL_OR => BinaryOp::class,
    Expr\BinaryOp::LOGICAL_XOR => BinaryOp::class,
    Expr\BinaryOp::SHIFT_LEFT => BinaryOp::class,
    Expr\BinaryOp::SHIFT_RIGHT => BinaryOp::class,
    Expr\AssignOp::CONCAT => AssignOp::class,
    Expr\AssignOp::PLUS => AssignOp::class,
    Expr\AssignOp::MINUS => AssignOp::class,
    Expr\AssignOp::DIV => AssignOp::class,
    Expr\AssignOp::MUL => AssignOp::class,
    Expr\AssignOp::BITWISE_AND => AssignOp::class,
    Expr\AssignOp::BITWISE_OR => AssignOp::class,
    Expr\AssignOp::BITWISE_XOR => AssignOp::class,
    Expr\AssignOp::BITWISE_MOD => AssignOp::class,
    Expr\AssignOp::SHIFT_LEFT => AssignOp::class,
    Expr\AssignOp::SHIFT_RIGHT => AssignOp::class,
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
    Expr\Cast::BOOL => Cast::class,
    Expr\Cast::INT => Cast::class,
    Expr\Cast::STRING => Cast::class,
    Expr\Cast::OBJECT => Cast::class,
    Expr\Cast::DOUBLE => Cast::class,
    Expr\Cast::ARRAY => Cast::class,
    Expr\Cast::UNSET => Cast::class,
    Expr::CLONE => Clone_::class,
    Expr::LIST => List_::class,
    Expr::UNARY_MINUS => UnaryMinus::class,
    Expr::UNARY_PLUS => UnaryPlus::class,
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
