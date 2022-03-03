<?php

namespace AOC\D6\P1;

use Closure;

/**
 * Class Timeline
 *
 * Represents a Timeline for a given number of days
 *
 * For each day within the timeline, once started, the provided $callback is fired
 *
 * @packagae AOC\D6\P1
 */
class Timeline
{
    public function __construct(private int $days, private Closure $callback) {}

    /**
     * Play the timeline
     */
    public function play(): void
    {
        $callback = $this->callback;

        for ($i = 1; $i <= $this->days; $i++) {
            $callback();
        }
    }
}
