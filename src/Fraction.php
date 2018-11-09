<?php

namespace Fraction;

class Fraction
{
    /** @var int */
    private $numerator;

    /** @var int */
    private $denominator;

    /**
     * @param int $numerator
     * @param int $denominator
     */
    public function __construct(int $numerator = 1, int $denominator = 1)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

    /**
     * Get the fraction in its simplest form.
     *
     * E.g. 5/10 becomes 1/2
     *
     * @return Fraction
     */
    public function simplified(): Fraction
    {
        return $this; // TODO
    }

    /**
     * @return float
     */
    public function asFloat(): float
    {
        return (float) ($this->numerator / $this->denominator);
    }

    /**
     * @return float
     */
    public function asPercentage(): float
    {
        return $this->asFloat() * 100;
    }
}
