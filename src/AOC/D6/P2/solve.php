<?php

namespace AOC\D6\P2;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$simulator = new FishSimulator(__DIR__ . '/../input.txt', 256);
$answer = $simulator->simulate();

die('Part 2: ' . $answer . "\n");