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
    case OPEN_ANSWER = 'OPEN_ANSWER';
    case MODEL_METHOD = 'MODEL_METHOD';
    case MODEL_METHOD_FREEFORM = 'MODEL_METHOD_FREEFORM';
}