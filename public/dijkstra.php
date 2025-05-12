<?php

use Neuralpin\DataStructure\Dijkstra;

require __DIR__.'/../vendor/autoload.php';

$graph = [
    'A' => ['B' => 3, 'D' => 3, 'F' => 6],
    'B' => ['A' => 3, 'D' => 1, 'E' => 3],
    'C' => ['E' => 2, 'F' => 3],
    'D' => ['A' => 3, 'B' => 1, 'E' => 1, 'F' => 2],
    'E' => ['B' => 3, 'C' => 2, 'D' => 1, 'F' => 5],
    'F' => ['A' => 6, 'C' => 3, 'D' => 2, 'E' => 5],
];

$Dijkstra = new Dijkstra($graph);

// Example usage
$result1 = $Dijkstra->shortestPath('D', 'C');  // 3:D->E->C
$result2 = $Dijkstra->shortestPath('C', 'A');  // 6:C->E->D->A
$result3 = $Dijkstra->shortestPath('B', 'F');  // 3:B->D->F
$result4 = $Dijkstra->shortestPath('F', 'A');  // 5:F->D->A
$result5 = $Dijkstra->shortestPath('A', 'G');  // No route from A to G

// Output results
print_r($result1);
print_r($result2);
print_r($result3);
print_r($result4);
print_r($result5);
