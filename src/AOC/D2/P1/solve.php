<?php

namespace AOC\D2\P1;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$lines = InputReader::fileToLines(__DIR__ . '/../input.txt');

$distances = [];

foreach ($lines as $line) {
    $matches = [];
    preg_match('/^(?<direction>\w+) (?<distance>\d+)$/', $line, $matches);
    $distances[$matches['direction']] ??= [];
    $distances[$matches['direction']][] = $matches['distance'];
}

foreach ($distances as $key => $values) {
    $distances[$key] = array_sum($values);
}

$answer = $distances['forward'] * ($distances['down'] - $distances['up']);

die('Part 1: ' . $answer . "\n");
