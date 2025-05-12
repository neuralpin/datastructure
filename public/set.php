<?php

use Neuralpin\DataStructure\Set;

require __DIR__ . '/../vendor/autoload.php';


$test = new Set(['red', 'green', 3.1415]);
$test->add((object) [1, 2, 3]);
// var_dump($test->count());
// var_dump($test->contains('green'));
// var_dump($test->contains('purple'));
// var_dump($test->get(0));
// var_dump($test->get(2));
// var_dump($test->get(3));
// var_dump($test->get(4));

// var_dump($test->toArray());

// var_dump($test->map(fn ($item) => gettype($item)));

// var_dump($test->last());
// var_dump($test->first());

// foreach($test as $k => $v){
//     var_dump([
//         'k' => $k,
//         'v' => $v,
//     ]);
// }

var_dump(json_encode($test));
