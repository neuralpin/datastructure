<?php

declare(strict_types=1);

namespace Neuralpin\DataStructure;

class Dijkstra
{
    /**
     * The graph represented as an adjacency list.
     * Keys are vertex names, and values are arrays of adjacent vertices with their costs.
     *
     * @var array<string, array<string, int>>
     */
    protected array $graph;

    protected array $distances;
    protected array $predecessors;

    /**
     * Constructor.
     *
     * @param  array<string, array<string, int>>  $graph  The graph data.
     */
    public function __construct(array $graph)
    {
        $this->graph = $graph;

        $this->distances = $this->initializeDistances();
        $this->predecessors = $this->initializePredecessors();
    }

    /**
     * Finds the shortest path between a source and a target vertex.
     *
     * @param  string  $source  The starting vertex.
     * @param  string  $target  The destination vertex.
     * @return array{path: array<string>, distance: int}|null An array containing the shortest path and its distance, or null if no path exists.
     */
    public function shortestPath(string $source, string $target): ?array
    {
        $distances = $this->distances;
        $predecessors = $this->predecessors;
        $priorityQueue = new Heap(Heap::MODE_MAX);

        $distances[$source] = 0;
        $priorityQueue->push(0, $source);

        while (! $priorityQueue->isEmpty()) {
            $currentVertex = $priorityQueue->pop()?->value;

            if (! isset($this->graph[$currentVertex])) {
                continue;
            }

            foreach ($this->graph[$currentVertex] as $neighbor => $cost) {
                $alternativeDistance = $distances[$currentVertex] + $cost;

                if ($alternativeDistance < $distances[$neighbor]) {
                    $distances[$neighbor] = $alternativeDistance;
                    $predecessors[$neighbor] = $currentVertex;
                    $priorityQueue->push($alternativeDistance, $neighbor);
                }
            }
        }

        return $this->reconstructPath($predecessors, $target, $distances);
    }

    /**
     * Initializes the distance array for all vertices.
     *
     * @return array<string, int> An array where keys are vertex names and values are initialized to INF.
     */
    protected function initializeDistances(): array
    {
        $distances = [];
        foreach (array_keys($this->graph) as $vertex) {
            $distances[$vertex] = INF;
        }

        return $distances;
    }

    /**
     * Initializes the predecessors array for all vertices.
     *
     * @return array<string, string|null> An array where keys are vertex names and values are initialized to null.
     */
    protected function initializePredecessors(): array
    {
        $predecessors = [];
        foreach (array_keys($this->graph) as $vertex) {
            $predecessors[$vertex] = null;
        }

        return $predecessors;
    }

    /**
     * Reconstructs the shortest path from the predecessors array.
     *
     * @param  array<string, string|null>  $predecessors  An array mapping each vertex to its predecessor in the shortest path.
     * @param  string  $target  The target vertex.
     * @param  array<string, int>  $distances  The array of shortest distances found.
     * @return array{path: array<string>, distance: int}|null An array containing the shortest path and its distance, or null if no path exists to the target.
     */
    protected function reconstructPath(array $predecessors, string $target, array $distances): ?array
    {
        $shortestPath = new Stack;
        $currentVertex = $target;
        $distance = $distances[$target] ?? INF;

        while (isset($predecessors[$currentVertex]) && $predecessors[$currentVertex] !== null) {
            $shortestPath->push($currentVertex);
            $currentVertex = $predecessors[$currentVertex];
        }

        if ($shortestPath->isEmpty() && $currentVertex !== $target) {
            return null; // No path found
        }

        $shortestPath->push($currentVertex);
        $pathArray = iterator_to_array($shortestPath);

        return [
            'path' => $pathArray,
            'distance' => ($distance === INF) ? 0 : $distance,
        ];
    }
}
