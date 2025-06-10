<?php

namespace Algebrakit\SDK\Enums;

enum ExerciseStatus: string
{
    case FINISHED = 'FINISHED';
    case CORRECT = 'CORRECT';
    case ERROR = 'ERROR';
    case VIRGIN = 'VIRGIN';
    case SUBMITTED = 'SUBMITTED';
    case GIVEUP = 'GIVEUP';
    case UNKNOWN = 'UNKNOWN';
}