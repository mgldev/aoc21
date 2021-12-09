<?php

namespace AOC\D3\P1;

/**
 * Class BaseDiagnosticReportParser
 *
 * @package AOC\D3\P1
 */
abstract class BaseDiagnosticReportParser
{
    /** @var array */
    protected $bitmap;

    /**
     * BaseDiagnosticReportParser constructor.
     *
     * @param array $diagnosticReport   An array of binary string values
     */
    public function __construct(array $diagnosticReport)
    {
        $this->generateBitmap($diagnosticReport);
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
}
