<?php

namespace AOC\D6\P2;

/**
 * Class FishSimulator
 *
 * Simulates the reproduction of laternfish (efficient implementation)
 *
 * @package AOC\D6\P1
 */
class FishSimulator
{
    /** @var int[] */
    private array $intervals = [];

    /**
     * Construct
     *
     * @param string $filename  Filename containing fish timers
     * @param int $days Number of days to simulate
     */
    public function __construct(string $filename, private int $days)
    {
        $data = array_map('intval', fgetcsv(fopen($filename, 'r')));
        $this->intervals = array_count_values($data) + array_fill(0, 9, 0);
    }

    /**
     * Simulate reproduction over the configured number of days
     *
     * @return int  The total number of fish at the end of the specified $days
     */
    public function simulate(): int
    {
        for ($i = 0; $i < $this->days; $i++) {
            $first = $this->intervals[0];
            for ($j = 0; $j <= 8; $j++) {
                $this->intervals[$j] = $j === 8 ? $first : $this->intervals[$j + 1] + ($j === 6 ? $first : 0);
            }
        }

        return array_sum($this->intervals);
    }
}