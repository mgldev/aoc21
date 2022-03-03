<?php

namespace AOC\D6\P1;

use AOC\Helper\InputReader;
use Countable;

/**
 * Class School
 *
 * Represents a school of Fish
 *
 * @package AOC\D6\P1
 */
class School implements Countable
{
    /** @var Fish[] */
    private array $fish = [];

    public function addFish(Fish $fish): self
    {
        $this->fish[] = $fish;

        return $this;
    }

    public function tick(): void
    {
        foreach ($this->fish as $fish) {
            $fish->tick();
        }
    }

    public function count(): int
    {
        return count($this->fish);
    }

    public static function fromFile(string $filename): self
    {
        $school = new School();

        $timers = array_map('intval', explode(',', file_get_contents($filename)));

        foreach ($timers as $timer) {
            $school->addFish(new Fish((int) $timer, $school));
        }

        return $school;
    }
}
