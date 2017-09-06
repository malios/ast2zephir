<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

abstract class Expr
{
    const ASSIGN = 'Expr_Assign';
    const ARRAY = 'Expr_Array';
    const ARRAY_ITEM = 'Expr_ArrayItem';
    const CONST_FETCH = 'Expr_ConstFetch';
    const CLASS_CONST_FETCH = 'Expr_ClassConstFetch';
    const PROPERTY_FETCH = 'Expr_PropertyFetch';
    const STATIC_PROPERTY_FETCH = 'Expr_StaticPropertyFetch';
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
    const BINARY_OP_POW = 'Expr_BinaryOp_Pow';
    const BINARY_OP_MODULUS = 'Expr_BinaryOp_Mod';
    const BINARY_OP_BITWISE_AND = 'Expr_BinaryOp_BitwiseAnd';
    const BINARY_OP_BITWISE_OR = 'Expr_BinaryOp_BitwiseOr';
    const BINARY_OP_BITWISE_XOR = 'Expr_BinaryOp_BitwiseXor';
    const BINARY_OP_BOOLEAN_AND = 'Expr_BinaryOp_BooleanAnd';
    const BINARY_OP_BOOLEAN_OR = 'Expr_BinaryOp_BooleanOr';
    const BINARY_OP_LOGICAL_AND = 'Expr_BinaryOp_LogicalAnd';
    const BINARY_OP_LOGICAL_OR = 'Expr_BinaryOp_LogicalOr';
    const BINARY_OP_LOGICAL_XOR = 'Expr_BinaryOp_LogicalXor';
    const BINARY_OP_SHIFT_LEFT = 'Expr_BinaryOp_ShiftLeft';
    const BINARY_OP_SHIFT_RIGHT = 'Expr_BinaryOp_ShiftRight';
    const VARIABLE = 'Expr_Variable';
    const TERNARY = 'Expr_Ternary';
    const PRINT = 'Expr_Print';
    const FUNC_CALL = 'Expr_FuncCall';
    const METHOD_CALL = 'Expr_MethodCall';
    const STATIC_CALL = 'Expr_StaticCall';
    const ARRAY_DIM_FETCH = 'Expr_ArrayDimFetch';
    const POST_INC = 'Expr_PostInc';
    const POST_DEC = 'Expr_PostDec';
    const EXIT = 'Expr_Exit';
    const NEW = 'Expr_New';
}
