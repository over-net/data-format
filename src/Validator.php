<?php
declare(strict_types=1);


namespace App;

final class Validator
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
    public static function mathExpression(string $expression, bool $ignoreEmptyExpression = false, string $wrap = self::BASE_WRAP): bool
    {
        $expression = trim($expression);
        $part = strlen($wrap) / 2;

        $definitions = [
            'expression_start' => substr($expression, 0, $part),
            'expression_end' => substr($expression, -$part),
            'wrap_start' => substr($expression, 0, $part),
            'wrap_end' => substr($expression, -$part)
        ];

        $cleanExpression = trim(
            substr($expression, $part, -$part)
        );
        $cleanExpression = str_replace(' ', '', $cleanExpression);

        $isMathExpression = $ignoreEmptyExpression || filter_var($cleanExpression, FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => self::REGEXP_MATH_EXPRESSION
                ]
            ]);

        return $definitions['expression_start'] === $definitions['wrap_start']
            && $definitions['expression_end'] === $definitions['wrap_end']
            && $isMathExpression;

    }

}