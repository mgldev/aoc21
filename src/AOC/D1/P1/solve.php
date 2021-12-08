<?php

namespace AOC\D1\P1;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$depths = InputReader::fileToLines(__DIR__ . '/../input.txt');

$prevDepth = null;
$depthsHigherThanPrevious = 0;

foreach ($depths as $depth) {
    if ($prevDepth !== null && $depth > $prevDepth) {
        $depthsHigherThanPrevious++;
    }
    $prevDepth = $depth;
}

die('Part 1: ' . $depthsHigherThanPrevious . "\n");