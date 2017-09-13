<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Enum\Expr;

abstract class BinaryOp
{
    const BINARY_OP = 'Expr_BinaryOp_';
    const PLUS = 'Expr_BinaryOp_Plus';
    const MINUS = 'Expr_BinaryOp_Minus';
    const MULTIPLY = 'Expr_BinaryOp_Mul';
    const DIVIDE = 'Expr_BinaryOp_Div';
    const EQUAL = 'Expr_BinaryOp_Equal';
    const IDENTICAL = 'Expr_BinaryOp_Identical';
    const NOT_IDENTICAL = 'Expr_BinaryOp_NotIdentical';
    const NOT_EQUAL = 'Expr_BinaryOp_NotEqual';
    const CONCAT = 'Expr_BinaryOp_Concat';
    const GREATER = 'Expr_BinaryOp_Greater';
    const GREATER_OR_EQUAL = 'Expr_BinaryOp_GreaterOrEqual';
    const SMALLER = 'Expr_BinaryOp_Smaller';
    const SMALLER_OR_EQUAL = 'Expr_BinaryOp_SmallerOrEqual';
    const POW = 'Expr_BinaryOp_Pow';
    const MODULUS = 'Expr_BinaryOp_Mod';
    const BITWISE_AND = 'Expr_BinaryOp_BitwiseAnd';
    const BITWISE_OR = 'Expr_BinaryOp_BitwiseOr';
    const BITWISE_XOR = 'Expr_BinaryOp_BitwiseXor';
    const BOOLEAN_AND = 'Expr_BinaryOp_BooleanAnd';
    const BOOLEAN_OR = 'Expr_BinaryOp_BooleanOr';
    const LOGICAL_AND = 'Expr_BinaryOp_LogicalAnd';
    const LOGICAL_OR = 'Expr_BinaryOp_LogicalOr';
    const LOGICAL_XOR = 'Expr_BinaryOp_LogicalXor';
    const SHIFT_LEFT = 'Expr_BinaryOp_ShiftLeft';
    const SHIFT_RIGHT = 'Expr_BinaryOp_ShiftRight';
}
