<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Enum;

abstract class Expr
{
    const ASSIGN = 'Expr_Assign';
    const ARRAY = 'Expr_Array';
    const ARRAY_ITEM = 'Expr_ArrayItem';
    const CONST_FETCH = 'Expr_ConstFetch';
    const CLASS_CONST_FETCH = 'Expr_ClassConstFetch';
    const PROPERTY_FETCH = 'Expr_PropertyFetch';
    const STATIC_PROPERTY_FETCH = 'Expr_StaticPropertyFetch';
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
    const ISSET = 'Expr_Isset';
    const EMPTY = 'Expr_Empty';
    const INSTANCEOF = 'Expr_Instanceof';
    const EVAL = 'Expr_Eval';
    const BOOLEAN_NOT = 'Expr_BooleanNot';
    const CLONE = 'Expr_Clone';
    const LIST = 'Expr_List';
}
