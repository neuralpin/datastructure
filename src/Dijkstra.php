<?php

declare(strict_types=1);

class Dijkstra
{
    protected $graph;

    public function __construct(array $graph)
    {
        $this->graph = $graph;
    }

    public function findShortestPath(string $source, string $target): object
    {
        $distances = $this->initializeDistances();
        $predecessors = $this->initializePredecessors();
        $priorityQueue = new SplPriorityQueue;

        $distances[$source] = 0;
        $priorityQueue->insert($source, 0);

        while (! $priorityQueue->isEmpty()) {
            $currentVertex = $priorityQueue->extract();

            if (! isset($this->graph[$currentVertex])) {
                continue;
            }

            foreach ($this->graph[$currentVertex] as $neighbor => $cost) {
                $alternativeDistance = $distances[$currentVertex] + $cost;

                if ($alternativeDistance < $distances[$neighbor]) {
                    $distances[$neighbor] = $alternativeDistance;
                    $predecessors[$neighbor] = $currentVertex;
                    $priorityQueue->insert($neighbor, $alternativeDistance);
                }
            }
        }

        return $this->buildPath($source, $target, $distances, $predecessors);
    }

    protected function initializeDistances(): array
    {
        $distances = [];
        foreach (array_keys($this->graph) as $vertex) {
            $distances[$vertex] = INF; // Set initial distance to "infinity"
        }

        return $distances;
    }

    protected function initializePredecessors(): array
    {
        return array_fill_keys(array_keys($this->graph), null);
    }

    protected function buildPath(string $source, string $target, array $distances, array $predecessors): object
    {
        $pathStack = new SplStack;
        $currentVertex = $target;
        $totalDistance = 0;

        while (isset($predecessors[$currentVertex]) && $predecessors[$currentVertex] !== null) {
            $pathStack->push($currentVertex);
            $totalDistance += $this->graph[$currentVertex][$predecessors[$currentVertex]];
            $currentVertex = $predecessors[$currentVertex];
        }

        if ($pathStack->isEmpty() && $currentVertex !== $source) {
            return (object) ['error' => "No route from $source to $target"];
        } else {
            $pathStack->push($source);

            return (object) [
                'distance' => $totalDistance,
                // 'path' => implode('->', iterator_to_array($pathStack)),
                'path' => $pathStack,
            ];
        }
    }
}

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
$result1 = $Dijkstra->findShortestPath('D', 'C');  // 3:D->E->C
$result2 = $Dijkstra->findShortestPath('C', 'A');  // 6:C->E->D->A
$result3 = $Dijkstra->findShortestPath('B', 'F');  // 3:B->D->F
$result4 = $Dijkstra->findShortestPath('F', 'A');  // 5:F->D->A
$result5 = $Dijkstra->findShortestPath('A', 'G');  // No route from A to G

// Output results
print_r($result1);
print_r($result2);
print_r($result3);
print_r($result4);
print_r($result5);
