<?php

namespace AOC\D6\P1;

require_once __DIR__ . '/../../../../vendor/autoload.php';

$school = School::fromFile(__DIR__ . '/../input.txt');
$days = 80;
$timeline = new Timeline($days,  fn () => $school->tick());
$timeline->play();
$totalFish = count($school);

die('Part 1: ' . $totalFish . "\n");
