<?php

namespace AOC\D2\P2;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$lines = InputReader::fileToLines(__DIR__ . '/../input.txt');

$forward = $aim = $depth = 0;

foreach ($lines as $line) {
    $matches = [];
    preg_match('/^(?<direction>\w+) (?<distance>\d+)$/', $line, $matches);
    $direction = $matches['direction'];
    $distance = $matches['distance'];

    switch ($direction) {
        case 'forward':
            $forward += $distance;
            $depth += $aim * $distance;
            break;

        case 'down':
            $aim += $distance;
            break;

        case 'up':
            $aim -= $distance;
            break;
    }
}

$answer = $forward * $depth;

die('Part 2: ' . $answer . "\n");