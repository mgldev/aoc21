<?php

namespace AOC\D3\P1;

use AOC\Helper\InputReader;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$diagnosticReport = InputReader::fileToLines(__DIR__ . '/../input.txt');
$powerConsumptionCalculator = new PowerConsumptionCalculator($diagnosticReport);
$answer = $powerConsumptionCalculator->calculatePowerConsumption();

die('Part 1: ' . $answer . "\n");