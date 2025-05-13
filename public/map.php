<?php

use Neuralpin\DataStructure\HashMap;

require __DIR__.'/../vendor/autoload.php';

$test = new HashMap([
    'color_1' => 'red',
    'color_2' => 'green',
    'value_1' => 3.1415,
]);

var_dump($test->count());
var_dump(isset($test['color_1']));
var_dump($test->hasKey('color_2'));
var_dump($test->hasValue('green'));
var_dump($test->hasValue('purple'));
var_dump($test->get('color_1'));
var_dump($test->get('value_1'));

// var_dump($test->get('lorem_1')); // Throws error

var_dump($test->toArray());

foreach ($test as $k => &$v) {
    var_dump("{$k} => {$v}");
    $v = 123;
}


foreach($test as $k => $v){
    var_dump("{$k} => {$v}");
}

$Map1 = new HashMap;
$Map1['a'] = new HashMap;
$Map1['a']['b'] = 'lorem';


var_dump($Map1);