<?php

namespace AOC\D3\P1;

/**
 * Class PowerConsumptionCalculator
 *
 * This component calculates the power consumption of the submarine for a given $diagnosticReport
 *
 * @package AOC\D3\P1
 */
class PowerConsumptionCalculator extends BaseDiagnosticReportParser
{
    /**
     * Calculates the power consumption for the $diagnosticReport used to construct the instance
     *
     * The power consumption is the decimal value of the gamma rate * decimal value of the epsilon rate
     *
     * @return int
     */
    public function calculatePowerConsumption(): int
    {
        $gamma = $epsilon = '';

        foreach ($this->bitmap as $bits) {
            $counts = array_count_values($bits); // generates a count for each value found (i.e. 1s and 0s)
            $mostCommonBit = $counts[0] > $counts[1] ? 0 : 1; // determine the most commonly occurring bit
            $leastCommonBit = $mostCommonBit === 1 ? 0 : 1; // simply flipping (binary can only be 1 or 0)
            $gamma .= $mostCommonBit;
            $epsilon .= $leastCommonBit;
        }

        return bindec($gamma) * bindec($epsilon);
    }
}
