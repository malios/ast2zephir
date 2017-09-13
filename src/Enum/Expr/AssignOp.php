<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Enum\Expr;

abstract class AssignOp
{
    const ASSIGN_OP = 'Expr_AssignOp_';
    const CONCAT = 'Expr_AssignOp_Concat';
    const PLUS = 'Expr_AssignOp_Plus';
    const MINUS = 'Expr_AssignOp_Minus';
    const DIV = 'Expr_AssignOp_Div';
    const MUL = 'Expr_AssignOp_Mul';
    const BITWISE_AND = 'Expr_AssignOp_BitwiseAnd';
    const BITWISE_OR = 'Expr_AssignOp_BitwiseOr';
    const BITWISE_XOR = 'Expr_AssignOp_BitwiseXor';
    const BITWISE_MOD = 'Expr_AssignOp_Mod';
    const SHIFT_LEFT = 'Expr_AssignOp_ShiftLeft';
    const SHIFT_RIGHT = 'Expr_AssignOp_ShiftRight';
}
