<?php

namespace AOC\D6\P1;

/**
 * Class Fish
 *
 * Represents a Fish which belongs to a School
 *
 * @package AOC\D6\P1
 */
class Fish
{
    private const NEW_FISH_TIMER_START = 8;

    public function __construct(private int $timer, private School $school) {}

    public function tick(): void
    {
        $this->timer--;

        // if the timer reaches zero, reset the timer to 6 and add a new Fish to the school
        if ($this->timer === -1) {
            $this->timer = 6;
            $this->school->addFish(new Fish(self::NEW_FISH_TIMER_START, $this->school));
        }
    }
}
