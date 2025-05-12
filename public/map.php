<?php

use Neuralpin\DataStructure\HashMap;

require __DIR__ . '/../vendor/autoload.php';

$test = new HashMap([
    'color_1' => 'red',
    'color_2' => 'green',
    'value_1' => 3.1415,
]);

// var_dump($test->count());
// var_dump($test->hasKey('color_2'));
// var_dump($test->hasKey('lorem_1'));
// var_dump($test->hasValue('green'));
// var_dump($test->hasValue('purple'));
// var_dump($test->get('color_1'));
// var_dump($test->get('value_1'));
// var_dump($test->get('lorem_1'));

var_dump($test->toArray());

var_dump($test->map(fn ($item) => gettype($item)));

// [todo] nested map style $a[$b][$c];
