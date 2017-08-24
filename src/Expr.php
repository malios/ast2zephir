<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

abstract class Expr
{
    const ASSIGN = 'Expr_Assign';
    const ARRAY = 'Expr_Array';
    const ARRAY_ITEM = 'Expr_ArrayItem';
    const CONST_FETCH = 'Expr_ConstFetch';
    const PROPERTY_FETCH = 'Expr_PropertyFetch';
    const BINARY_OP = 'Expr_BinaryOp_';
    const BINARY_OP_PLUS = 'Expr_BinaryOp_Plus';
    const BINARY_OP_MINUS = 'Expr_BinaryOp_Minus';
    const BINARY_OP_MULTIPLY = 'Expr_BinaryOp_Mul';
    const BINARY_OP_DIVIDE = 'Expr_BinaryOp_Div';
    const BINARY_OP_EQUAL = 'Expr_BinaryOp_Equal';
    const BINARY_OP_IDENTICAL = 'Expr_BinaryOp_Identical';
    const BINARY_OP_NOT_IDENTICAL = 'Expr_BinaryOp_NotIdentical';
    const BINARY_OP_NOT_EQUAL = 'Expr_BinaryOp_NotEqual';
    const BINARY_OP_CONCAT = 'Expr_BinaryOp_Concat';
    const BINARY_OP_GREATER = 'Expr_BinaryOp_Greater';
    const BINARY_OP_GREATER_OR_EQUAL = 'Expr_BinaryOp_GreaterOrEqual';
    const BINARY_OP_SMALLER = 'Expr_BinaryOp_Smaller';
    const BINARY_OP_SMALLER_OR_EQUAL = 'Expr_BinaryOp_SmallerOrEqual';
    const VARIABLE = 'Expr_Variable';
}
