<?php

use Neuralpin\DataStructure\FixedArray;

require __DIR__.'/../vendor/autoload.php';

$MyTest = new FixedArray(2);
$MyTest->push('Mercurio');
$MyTest->push('Venus');
$MyTest[1] = 'Tierra';

try {
    $MyTest->push('Lorem ipsum');
} catch (Exception $error) {
    var_dump($error->getMessage());
}
try {
    $MyTest['a'] = 'Lorem ipsum';
} catch (Exception $error) {
    var_dump($error->getMessage());
}
var_dump($MyTest);

// echo count($MyTest);
// echo $MyTest->capacity();

// $MyTest = new FixedArray(3);

// $MyTest[1] = 'Lorem';
// $MyTest['ipsum'] = 123456;
// unset($MyTest[1]);
// $MyTest['algo'] = 'algo';
// $MyTest['lo que sea'] = 'lo que sea';
// var_dump($MyTest);
// echo count($MyTest);

// // pop clear isset

// echo $MyTest[0];

foreach ($MyTest as $k => $v) {
    var_dump("$k => $v");
}
var_dump(json_encode($MyTest));
