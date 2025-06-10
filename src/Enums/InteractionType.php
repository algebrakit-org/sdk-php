<?php

namespace Algebrakit\SDK\Enums;

enum InteractionType: string
{
    case MULTISTEP = 'MULTISTEP';
    case MATH_TABLE = 'MATH_TABLE';
    case FILL_IN_THE_BLANKS = 'FILL_IN_THE_BLANKS';
    case GEOMETRY = 'GEOMETRY';
    case STATISTICS = 'STATISTICS';
    case NUMBER_LINE = 'NUMBER_LINE';
    case ARITHMETIC = 'ARITHMETIC';
    case CHOICE = 'CHOICE';
}