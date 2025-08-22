<?php

namespace Algebrakit\SDK\Enums;

enum AnnotationType: string
{
    case HINT = 'HINT';
    case ERROR_FEEDBACK = 'ERROR_FEEDBACK';
    case INPUT_EXPRESSION = 'INPUT_EXPRESSION';
    case SELECTED_OPTIONS = 'SELECTED_OPTIONS';
    case INPUT = 'INPUT';
}