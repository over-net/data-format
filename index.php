<?php
declare(strict_types=1);


require_once 'vendor/autoload.php';

use  App\Validator;

$expressions = [
    '[({5*(10*(1+0,2))})]',
    '[({5a*(10*(1+0,2))})]', // @todo: is also a mathematical expression, but it can be written into regular expression
    '[({})]',
    '[({1})]', // @todo: should make deeper analyser, not regexp, `cause here does not count is expression full or not
    ''
];

foreach ($expressions as $key => $expression) {
    dump(Validator::mathExpression($expression, $key === 2)); // If $key === 2 check out empty expression and allow to ignore this
}


?>

<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

