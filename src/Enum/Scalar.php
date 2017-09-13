<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Enum;

abstract class Scalar
{
    const LNUMBER = 'Scalar_LNumber';
    const STRING = 'Scalar_String';
    const DNUMBER = 'Scalar_DNumber';
    const ENCAPSED = 'Scalar_Encapsed';
    const ENCAPSED_STRING_PART = 'Scalar_EncapsedStringPart';
}
