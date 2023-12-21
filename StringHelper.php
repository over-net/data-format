<?php
declare(strict_types=1);


final class StringHelper
{


    public static function validateExpression(string $string, string $regexp): bool
    {
        return filter_var($string, FILTER_VALIDATE_REGEXP, [
            'options' => $regexp
        ]);
    }

}