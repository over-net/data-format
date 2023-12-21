<?php
declare(strict_types=1);


namespace App;

final class StringHelper
{

    public const REGEXP_MATH_EXPRESSION = '/^[0-9\+\-\*\/\(\)\.\,]+$/';
    public const BASE_WRAP = '[({})]';



    /**
     * @param string $expression
     * @param bool   $ignoreEmptyExpression
     * @param string $wrap
     *
     * @return bool
     */
    public static function validateMathExpression(string $expression, bool $ignoreEmptyExpression = false, string $wrap = self::BASE_WRAP): bool
    {
        $expression = trim($expression);
        $part = strlen($wrap) / 2;

        $expressionStart = substr($expression, 0, $part);
        $expressionEnd = substr($expression, -$part);
        $wrapStart = substr($expression, 0, $part);
        $wrapEnd = substr($expression, -$part);

        $cleanExpression = substr($expression, $part, -$part);
        $cleanExpression = trim($cleanExpression);
        $cleanExpression = str_replace(' ', '', $cleanExpression);

        $isMathExpression = $ignoreEmptyExpression || (bool)filter_var($cleanExpression, FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => self::REGEXP_MATH_EXPRESSION
                ]
            ]);

        return $expressionStart === $wrapStart && $expressionEnd === $wrapEnd && $isMathExpression;

    }

}