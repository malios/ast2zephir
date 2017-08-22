<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

abstract class Expr
{
    const ASSIGN = 'Expr_Assign';
    const ARRAY = 'Expr_Array';
    const ARRAY_ITEM = 'Expr_ArrayItem';
    const CONST_FETCH = 'Expr_ConstFetch';
    const PROPERTY_FETCH = 'Expr_PropertyFetch';
}
