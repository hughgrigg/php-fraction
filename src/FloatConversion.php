<?php

namespace Fraction;

class FloatConversion
{
    /** @var float */
    private $float;

    /** @var float */
    private $precision;

    /**
     * @param float      $float
     * @param float|null $precision
     */
    public function __construct(float $float, float $precision = null)
    {
        $this->float = $float;
        if ($precision === null) {
            $precision = 0.001; // TODO: determine precision from passed float
        }
        $this->precision = $precision;
    }

    /**
     * @return Fraction
     */
    public function fraction(): Fraction
    {
        return new Fraction(); // TODO
    }

    /**
     * Adjust the precision for float->fraction conversion.
     *
     * @param float $precision
     *
     * @return FloatConversion
     */
    public function withPrecision(float $precision): self
    {
        return new static($this->float, $precision);
    }
}
