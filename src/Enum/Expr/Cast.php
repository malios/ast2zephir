<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Enum\Expr;

abstract class Cast
{
    const CAST = 'Expr_Cast_';
    const BOOL = 'Expr_Cast_Bool';
    const INT = 'Expr_Cast_Int';
    const STRING = 'Expr_Cast_String';
    const OBJECT = 'Expr_Cast_Object';
    const DOUBLE = 'Expr_Cast_Double';
    const ARRAY = 'Expr_Cast_Array';
    const UNSET = 'Expr_Cast_Unset';
}
