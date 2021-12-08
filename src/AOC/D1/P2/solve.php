<?php

namespace AOC\D1\P2;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$numbers = InputReader::fileToLines(__DIR__ . '/../input.txt');
$count = count($numbers);
$sum = fn (array $indexes) => array_sum(array_map(fn (int $index) => $numbers[$index], $indexes));
$countSumsLargerThanPrev = 0;

for ($i = 1; $i < $count - 2; $i++) {
    $curIndexes = [$i, $i + 1, $i + 2];
    $prevIndexes = array_map(fn (int $index) => $index - 1, $curIndexes);
    $countSumsLargerThanPrev += (int) $sum($curIndexes) > $sum($prevIndexes);
}

echo 'Part 2: ' . $countSumsLargerThanPrev . "\n";