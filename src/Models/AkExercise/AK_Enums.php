<?php

namespace Algebrakit\SDK\Models\AkExercise;

enum AK_QuestionMode: string
{
    case ONE_BY_ONE = 'ONE_BY_ONE';
    case ALL_AT_ONCE = 'ALL_AT_ONCE';
}

enum AK_SymbolType: string
{
    case VARIABLE = 'VARIABLE';
    case CONSTANT = 'CONSTANT';
    case FUNCTION = 'FUNCTION';
    case FREEVARIABLE = 'FREEVARIABLE';
}

enum AK_InteractionType: string
{
    case MULTISTEP = 'MULTISTEP';
    case CHOICE = 'CHOICE';
    case FILL_IN_THE_BLANKS = 'FILL_IN_THE_BLANKS';
    case MATH_TABLE = 'MATH_TABLE';
}

enum AK_TaskType: string
{
    case SIMPLIFY = 'SIMPLIFY';
    case SOLVE = 'SOLVE';
    case SOLVE_SYSTEM = 'SOLVE_SYSTEM';
    case EXPAND = 'EXPAND';
    case FACTOR = 'FACTOR';
    case TOGETHER = 'TOGETHER';
    case COMPLETE_SQUARE = 'COMPLETE_SQUARE';
    case POLYNOMIAL_STANDARD_FORM = 'POLYNOMIAL_STANDARD_FORM';
    case POWER_STANDARD_FORM = 'POWER_STANDARD_FORM';
    case EXPONENTIAL_STANDARD_FORM = 'EXPONENTIAL_STANDARD_FORM';
    case CARTESIAN_TO_POLAR_FORM = 'CARTESIAN_TO_POLAR_FORM';
    case POLAR_TO_CARTESIAN_FORM = 'POLAR_TO_CARTESIAN_FORM';
}

enum AK_ElementBlockType: string
{
    case CONTENT = 'CONTENT';
    case INTERACTION = 'INTERACTION';
}

enum AK_FieldSize: string
{
    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case LARGE = 'LARGE';
}

enum AK_BlankType: string
{
    case EXPRESSION = 'EXPRESSION';
    case SELECTION = 'SELECTION';
}

enum AK_CellType: string
{
    case TEXT = 'text';
    case MATH = 'math';
    case INPUT = 'input';
}

enum AK_AccuracyType: string
{
    case ROUND = 'ROUND';
    case ROUND_UP = 'ROUND_UP';
    case ROUND_DOWN = 'ROUND_DOWN';
    case ACCURATE = 'ACCURATE';
    case PRECISION = 'PRECISION';
}

enum AK_NumberForm: string
{
    case DECIMAL_REQUIRED = 'DECIMAL_REQUIRED';
    case DECIMAL_PREFERRED = 'DECIMAL_PREFERRED';
    case FRACTION_REQUIRED = 'FRACTION_REQUIRED';
    case FRACTION_PREFERRED = 'FRACTION_PREFERRED';
    case SCIENTIFIC_NOTATION_REQUIRED = 'SCIENTIFIC_NOTATION_REQUIRED';
    case SCIENTIFIC_NOTATION_PREFERRED = 'SCIENTIFIC_NOTATION_PREFERRED';
}

enum AK_RadicalForm: string
{
    case STANDARD_FORM_REQUIRED = 'STANDARD_FORM_REQUIRED';
}

enum AK_FractionForm: string
{
    case MIXED_FRACTION_REQUIRED = 'MIXED_FRACTION_REQUIRED';
    case IMPROPER_FRACTION_REQUIRED = 'IMPROPER_FRACTION_REQUIRED';
}

enum AK_InitialExpressionType: string
{
    case NONE = 'NONE';
    case CUSTOM = 'CUSTOM';
    case AUTOMATIC = 'AUTOMATIC';
}

enum AK_StudentFeedbackType: string
{
    case ALL = 'ALL';
    case ICONS_ONLY = 'ICONS_ONLY';
    case ERRORS_ONLY = 'ERRORS_ONLY';
    case NONE = 'NONE';
}
