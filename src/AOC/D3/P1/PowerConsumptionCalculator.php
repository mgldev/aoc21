<?php

namespace AOC\D3\P1;

/**
 * Class PowerConsumptionCalculator
 *
 * This component calculates the power consumption of the submarine for a given $diagnosticReport
 *
 * @package AOC\D3\P1
 */
class PowerConsumptionCalculator
{
    /** @var array */
    private $bitmap;

    /**
     * PowerConsumptionCalculator constructor.
     *
     * @param array $diagnosticReport   An array of binary string values
     */
    public function __construct(array $diagnosticReport)
    {
        $this->generateBitmap($diagnosticReport);
    }

    /**
     * Calculates the power consumption for the $diagnosticReport used to construct the instance
     *
     * The power consumption is the decimal value of the gamma rate * decimal value of the epsilon rate
     *
     * @return int
     */
    public function calculatePowerConsumption(): int
    {
        return $this->generateGammaRate() * $this->generateEpsilonRate();
    }

    /**
     * Generate the gamma rate (uses the most commonly occurring bit in each column of the $diagnosticReport)
     *
     * Converts the generated rate from binary to decimal
     *
     * @return int
     */
    private function generateGammaRate(): int
    {
        return bindec($this->generateRate(true));
    }

    /**
     * Generate the epsilon rate (uses the least commonly occurring bit in each column of the $diagnosticReport)
     *
     * Converts the generated rate from binary to decimal
     *
     * @return int
     */
    private function generateEpsilonRate(): int
    {
        return bindec($this->generateRate(false));
    }

    /**
     * Converts the given $diagnosticReport in to a multi-dimensional bitmap, i.e:
     *
     * [
     *      0 => '11010',
     *      1 => '01001',
     *      2 => '10001'
     * ]
     *
     * becomes
     *
     * [
     *      0 => [1, 0, 1],
     *      1 => [1, 1, 0],
     *      2 => [0, 0 ,0],
     *      3 => [1, 0, 0],
     *      4 => [0, 1, 1]
     * ]
     *
     * This allows us to work with the entire $diagnosticReport as a series of columns:
     *
     * A        B       C       D       E
     * 1        1       0       1       0
     * 0        1       0       0       1
     * 1        0       0       0       1
     *
     * Column A contains the bits 1, 0, 1
     * Column B contains the bits 1, 1, 0
     * etc
     *
     * @param array $diagnosticReport
     */
    private function generateBitmap(array $diagnosticReport): void
    {
        foreach ($diagnosticReport as $binaryNumber) {
            $bits = str_split($binaryNumber);

            foreach ($bits as $index => $bit) {
                $this->bitmap[$index] ??= [];
                $this->bitmap[$index][] = $bit;
            }
        }
    }

    /**
     * Generates a 'rate' for the $diagnosticReport used to construct the instance
     *
     * A rate is calculated by analysing each 'column' of the diagnostic report, which
     * is a collection of bits, and determining a new bit by taking the most common or
     * least common bit in the column.
     *
     * The process is repeated for each column until we have a new binary number (the rate)
     *
     * @param bool $useMostCommonBit     If this value is true, the most commonly occurring bit is used, otherwise
     *                                  the least commonly occurring bit is used
     *
     * @return string   The rate as a binary number string
     */
    private function generateRate(bool $useMostCommonBit): string
    {
        $rate = [];

        foreach ($this->bitmap as $column => $bits) {
            $counts = array_count_values($bits); // generates a count for each value found (i.e. 1s and 0s)
            $mostCommonBit = $counts[0] > $counts[1] ? 0 : 1; // determine the most commonly occurring bit
            $leastCommonBit = $mostCommonBit === 1 ? 0 : 1; // simply flipping (binary can only be 1 or 0)
            $rate[$column] = $useMostCommonBit ? $mostCommonBit : $leastCommonBit;
        }

        return implode('', $rate);
    }
}
