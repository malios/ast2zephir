#### Binary OP
- ~~Expr_BinaryOp_BitwiseAnd (a & b)~~
- ~~Expr_BinaryOp_BitwiseOr (a | b)~~
- ~~Expr_BinaryOp_BitwiseXor (a ^ b)~~
- ~~Expr_BinaryOp_BooleanAnd (a && b)~~
- ~~Expr_BinaryOp_BooleanOr (a || b)~~
- ~~Expr_BinaryOp_LogicalAnd (a and b)~~
- ~~Expr_BinaryOp_LogicalOr (a or b)~~
- ~~Expr_BinaryOp_LogicalXor (a xor b)~~
- ~~Expr_BinaryOp_ShiftLeft (a << b)~~
- ~~Expr_BinaryOp_ShiftRight (a >> b)~~

#### Assign
- Expr_AssignOp_BitwiseAnd (a &= b) ---> (a = a & b)
- Expr_AssignOp_BitwiseOr (a |= b)
- Expr_AssignOp_BitwiseXor (a ^= b)
- Expr_AssignOp_Concat (a .= b)
- Expr_AssignOp_Div (a /= b)
- Expr_AssignOp_Minus (a -= b)
- Expr_AssignOp_Mod (a %= b)
- Expr_AssignOp_Mul (a *= b)
- Expr_AssignOp_Plus (a += b) - test for arrays too
- Expr_AssignOp_Pow (a *= b)
- Expr_AssignOp_ShiftLeft (a <<= b)
- Expr_AssignOp_ShiftRight (a >>= b)

#### Types

- ~~Primitive type hints~~
- ~~Class\Interface type hints~~
- ~~Primitive return types~~
- ~~Class\Interface return types~~
- Void return type from annotations
- Primitive type hints from annotations
- Class\Interface type hints from annotations
- Primitive return types from annotations
- Class\Interface return types from annotations

#### Additional

- Support for inline html (workaround)
- Support for traits (workaround)
- String interpolation


#### conditional

- ~~if/elseif/else~~
- ~~switch~~
- ~~ternary~~


#### loops
- ~~for~~
- ~~foreach~~
- ~~while~~
- do while

#### oop
- method call
- interfaces
- traits

#### other
- function call
- regex
- goto
- exceptions (throw/catch/finally)

#### improvements
- comments
- keep empty lines

#### code improbements
- use di container instead of finder
- consider caching generators


#### compatibility (with zephir)

- Given the following code:

```Zephir
public function test(): bool
{
    if a < b {
        return true;
    } else {
        return false;
    }
}
```

Zephir compiler will throw error "Reached end of the method without returning a valid type specified in the return-type hints in...".
We need a way to check for this kind of stuff in PHP.

