<?php

namespace AOC\D1\P1;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$lines = InputReader::fileToLines(__DIR__ . '/../input.txt');

$map = [];

foreach ($lines as $line) {
    $matches = [];
    preg_match('/^(?<direction>\w+) (?<distance>\d+)$/', $line, $matches);
    $direction = $matches['direction'];
    $distance = $matches['distance'];
    $map[$direction] ??= [];
    $map[$direction][] = $distance;
}

$totalForward = array_sum($map['forward']);
$totalUp = array_sum($map['up']);
$totalDown = array_sum($map['down']);
$totalDepth = $totalDown - $totalUp;

$answer = $totalForward * $totalDepth;

die('Part 1: ' . $answer . "\n");