<?php

namespace AOC\D3\P2;

use AOC\D3\P1\BaseDiagnosticReportParser;

/**
 * Class LifeSupportRatingCalculator
 *
 * This component calculates the life support rating of the submarine for a given $diagnosticReport
 *
 * @package AOC\D3\P2
 */
class LifeSupportRatingCalculator extends BaseDiagnosticReportParser
{
    /**
     * Calculates the life support rating for the $diagnosticReport used to construct the instance
     *
     * @return int
     */
    public function calculateSupportRating(): int
    {
        $oxygenRating = $this->generateBinaryRating(true);
        $co2Rating = $this->generateBinaryRating(false);

        return bindec($oxygenRating) * bindec($co2Rating);
    }

    /**
     * Generate a binary rating for the $diagnosticReport used to construct the instance
     *
     * @param bool $useMostCommon   Specify if the most common bit should be used, otherwise least common will be used
     *
     * @return string
     */
    private function generateBinaryRating(bool $useMostCommon): string
    {
        $bitmap = $this->bitmap;
        $columnCount = count($bitmap);
        $equalBit = (int) $useMostCommon;

        for ($columnIndex = 0; $columnIndex < $columnCount; $columnIndex++) {
            $bits = $bitmap[$columnIndex];
            $counts = array_count_values($bits);
            $bitsAreEqual = $counts[0] === $counts[1];
            $mostCommonBit = $counts[0] > $counts[1] ? 0 : 1;
            $leastCommonBit = $mostCommonBit === 1 ? 0 : 1;
            $keepBit = $bitsAreEqual ? $equalBit : ($useMostCommon ? $mostCommonBit : $leastCommonBit);
            $removeBit = $keepBit === 1 ? 0 : 1;
            $bitmap = $this->removeRowByIndexAndBit($bitmap, $columnIndex, $removeBit);
            $rating = $this->generateRating($bitmap);

            if ($rating !== null) {
                return $rating;
            }
        }
    }

    /**
     * Generate the rating for the given $bitmap
     *
     * A rating can only be generated when the $bitmap has been reduced to a single row
     *
     * @param array $bitmap
     *
     * @return string|null
     */
    private function generateRating(array $bitmap): ?string
    {
        if (count($bitmap[0]) > 1) {
            return null;
        }

        return implode(array_map(fn ($bits) => array_pop($bits), $bitmap));
    }

    /**
     * Remove all rows from the $bitmap where the values in the specified $columnIndex match the specified $removalBit
     *
     * @param array $bitmap     The bitmap to modify
     * @param int $columnIndex  The column index to look for bit matches
     * @param int $removalBit   The bit value to match which causes row removal
     *
     * @return array            The modified bitmap with rows removed
     */
    private function removeRowByIndexAndBit(array $bitmap, int $columnIndex, int $removalBit): array
    {
        $count = count($bitmap);

        foreach ($bitmap[$columnIndex] as $bitIndex => $columnBit) {
            if ((int) $columnBit === $removalBit) {
                for ($i = 0; $i < $count; $i++) {
                    unset($bitmap[$i][$bitIndex]);
                }
            }
        }

        return $bitmap;
    }
}
