<?php

namespace AOC\D3\P2;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$diagnosticReport = InputReader::fileToLines(__DIR__ . '/../input.txt');

$lifeSupportRatingCalculator = new LifeSupportRatingCalculator($diagnosticReport);
$answer = $lifeSupportRatingCalculator->calculateSupportRating();

die('Part 2: ' . $answer . "\n");