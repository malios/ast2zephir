<?php declare(strict_types=1);

namespace Malios\Ast2Zephir;

abstract class Stmt
{
    const NAMESPACE = 'Stmt_Namespace';
    const USE = 'Stmt_Use';
    const USE_USE = 'Stmt_UseUse';
    const GROUP_USE = 'Stmt_GroupUse';
    const DECLARE = 'Stmt_Declare';
    const CLASS_ = 'Stmt_Class';
    const CLASS_METHOD = 'Stmt_ClassMethod';
    const CLASS_CONST = 'Stmt_ClassConst';
    const PROPERTY = 'Stmt_Property';
    const PROPERTY_PROPERTY = 'Stmt_PropertyProperty';
    const RETURN = 'Stmt_Return';
    const IF = 'Stmt_If';
    const ELSE = 'Stmt_Else';
    const ELSEIF = 'Stmt_ElseIf';
    const NOP = 'Stmt_Nop';
    const SWITCH = 'Stmt_Switch';
    const BREAK = 'Stmt_Break';
    const ECHO = 'Stmt_Echo';
    const FOREACH = 'Stmt_Foreach';
}
