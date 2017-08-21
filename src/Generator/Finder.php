<?php

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Expr;
use Malios\Ast2Zephir\Generator\Exception\GeneratorNotFoundException;
use Malios\Ast2Zephir\Generator\Expr\Array_;
use Malios\Ast2Zephir\Generator\Expr\ArrayItem;
use Malios\Ast2Zephir\Generator\Expr\Assign;
use Malios\Ast2Zephir\Generator\Expr\ConstFetch;
use Malios\Ast2Zephir\Generator\Scalar\DNumber;
use Malios\Ast2Zephir\Generator\Scalar\LNumber;
use Malios\Ast2Zephir\Generator\Scalar\String_;
use Malios\Ast2Zephir\Generator\Stmt\Class_;
use Malios\Ast2Zephir\Generator\Stmt\ClassConst;
use Malios\Ast2Zephir\Generator\Stmt\GroupUse;
use Malios\Ast2Zephir\Generator\Stmt\Namespace_;
use Malios\Ast2Zephir\Generator\Stmt\Property;
use Malios\Ast2Zephir\Generator\Stmt\PropertyProperty;
use Malios\Ast2Zephir\Generator\Stmt\Use_;
use Malios\Ast2Zephir\Generator\Stmt\UseUse;
use Malios\Ast2Zephir\Scalar;
use Malios\Ast2Zephir\Stmt;

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
        Scalar::LNUMBER => LNumber::class,
        Scalar::DNUMBER => DNumber::class,
        Scalar::STRING => String_::class,
        Stmt::NAMESPACE => Namespace_::class,
        Stmt::USE => Use_::class,
        Stmt::USE_USE => UseUse::class,
        Stmt::GROUP_USE => GroupUse::class,
        Stmt::DECLARE => Noop::class,
        Stmt::CLASS_ => Class_::class,
        Stmt::CLASS_CONST => ClassConst::class,
        Stmt::PROPERTY => Property::class,
        Stmt::PROPERTY_PROPERTY => PropertyProperty::class,
        'Const' => Const_::class,
    ];

    public function find(string $name) : Generator
    {
        if (isset($this->mapping[$name])) {
            $generator = new $this->mapping[$name]($this);
            return $generator;
        }

        throw new GeneratorNotFoundException(sprintf('Generator for node type %s not found', $name));
    }
}
