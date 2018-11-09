<?php

namespace Fraction\Tests;

use Fraction\Fraction;
use PHPUnit\Framework\TestCase;

class FractionAsFloatTest extends TestCase
{
    /**
     * @dataProvider fractionAsFloatProvider
     *
     * @param int   $numerator
     * @param int   $denominator
     * @param float $expectedFloat
     */
    public function testFractionAsFloat(
        int $numerator,
        int $denominator,
        float $expectedFloat
    ): void {
        // Given we have a fraction;
        $fraction = new Fraction($numerator, $denominator);

        // When we get the fraction as a float;
        $float = $fraction->asFloat();

        // Then the float should be as expected.
        self::assertEquals(
            $expectedFloat,
            $float,
            "{$numerator}/${denominator} should be {$expectedFloat}; got {$float}",
            0.001
        );
    }

    /**
     * @return array[]
     */
    public function fractionAsFloatProvider(): array
    {
        return [
            [1, 1, 1.0],
            [1, 2, 0.5],
            [1, 3, 0.333],
            [1, 4, 0.25],
            [1, 5, 0.2],
            [2, 3, 0.666],
            [3, 3, 1.0],
            [5, 10, 0.5],
            [3, 1, 3.0],
            [3, 2, 1.5],
            [-1, 1, -1.0],
            [-1, 2, -0.5],
            [-1, 8, -0.125],
        ];
    }

    /**
     * @param int   $numerator
     * @param int   $denominator
     * @param float $expectedPercentage
     */
    public function testFractionAsPercentage(
        int $numerator,
        int $denominator,
        float $expectedPercentage
    ): void {
        // Given we have a fraction;
        $fraction = new Fraction($numerator, $denominator);

        // When we get it as a percentage;
        $percentage = $fraction->asPercentage();

        // Then the percentage should be as expected.
        self::assertEquals(
            $expectedPercentage,
            $percentage,
            "{$numerator}/${denominator} should be {$expectedPercentage}%; got {$percentage}%",
            0.001
        );
    }

    /**
     * @return array[]
     */
    public function fractionAsPercentageProvider(): array
    {
        return [
            [1, 1, 100],
            [1, 2, 50],
            [1, 3, 33.333],
            [1, 4, 25],
            [1, 5, 20],
            [2, 3, 66.666],
            [3, 3, 100],
            [5, 10, 50],
            [3, 1, 300],
            [3, 2, 150],
        ];
    }
}
