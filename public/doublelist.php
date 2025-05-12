<?php

use Neuralpin\DataStructure\DoubleLinkedList;

require __DIR__.'/../vendor/autoload.php';

$MyList = new DoubleLinkedList;
$MyList->push('Computer science');
$MyList->push('Algorithms');
$MyList->push('Data Structures');

// $MyList->unshift('Index');

// // var_dump($MyList);

// var_dump($MyList->shift());

foreach ($MyList as $k => $v) {
    var_dump("{$k} => {$v}");
}

var_dump(json_encode($MyList));

// $EmptyList = new DoubleLinkedList;
// var_dump([
//     'top' => $EmptyList->top(),
//     'bottom' => $EmptyList->bottom(),
// ]);
// var_dump($EmptyList->shift());
// var_dump($EmptyList->pop());
// var_dump($EmptyList);

// foreach ($EmptyList->generator() as $k => $v) {
//     var_dump("{$k} => {$v}");
// }

// $SingleElement = new DoubleLinkedList;
// $SingleElement->push('lorem');
// var_dump([
//     'top' => $SingleElement->top(),
//     'bottom' => $SingleElement->bottom(),
// ]);
// var_dump($SingleElement->pop());
// var_dump($SingleElement);

// foreach ($SingleElement->generator() as $k => $v) {
//     var_dump("{$k} => {$v}");
// }

// $ShitTest = new DoubleLinkedList;
// $ShitTest->unshift('lorem');
// $ShitTest->unshift('ipsum');
// var_dump([
//     'top' => $ShitTest->top(),
//     'bottom' => $ShitTest->bottom(),
// ]);
// var_dump($ShitTest->shift());
// var_dump($ShitTest);

// $ReverseTest = new DoubleLinkedList;
// $ReverseTest->push(1);
// $ReverseTest->push(2);
// $ReverseTest->push(3);
// $ReverseTest->push(4);
// $ReverseTest->push(5);
// $ReverseTest->unshift(0);
// foreach($ReverseTest->generator() as $value){
//     var_dump($value);
// }
// foreach($ReverseTest->reverseGenerator() as $value){
//     var_dump($value);
// }

// $RemovingTest = new DoubleLinkedList;
// $nodeFirst = $RemovingTest->push(1);
// $nodeSecond = $RemovingTest->push(2);
// $nodeThird = $RemovingTest->push(3);

// $nodeSecond->remove();
// foreach ($RemovingTest->generator() as $value) {
//     var_dump($value);
// }
// // var_dump($nodeSecond);

// $nodeFirst->remove();
// var_dump($RemovingTest);

// $nodeThird->remove();
// var_dump($RemovingTest);

// $RemovingFromBottomTest = new DoubleLinkedList;
// $nodeFirst = $RemovingFromBottomTest->push(1);
// $nodeSecond = $RemovingFromBottomTest->push(2);
// $nodeSecond->remove();
// var_dump($RemovingFromBottomTest);

// var_dump($MyList->pop());
// var_dump($MyList->pop());
// var_dump($MyList);

// $BreadcrumbList = [
//     (object) [
//         'id' => 456,
//         'title' => 'Data Structures',
//         'parent' => 234,
//     ],
//     (object) [
//         'id' => 124,
//         'title' => 'Computer science',
//         'parent' => 123,
//     ],
//     (object) [
//         'id' => 234,
//         'title' => 'Algorithms',
//         'parent' => 124,
//     ],
//     (object) [
//         'id' => 123,
//         'title' => 'Index',
//         'parent' => 0,
//     ],
// ];

// $BreadcrumbMap = [];
// $List = null;
// foreach($BreadcrumbList as $Item){
//     $BreadcrumbMap[$Item->id] = new DoubleLinkedListNode($Item);

//     if($Item->parent === 0){
//         $List = $BreadcrumbMap[$Item->id];
//     }
// }

// foreach ($BreadcrumbMap as $Item) {
//     if (isset($BreadcrumbMap[$Item->value->parent])) {
//         $BreadcrumbMap[$Item->value->parent]->next = $BreadcrumbMap[$Item->value->id];
//     }
// }

// var_dump($List);
