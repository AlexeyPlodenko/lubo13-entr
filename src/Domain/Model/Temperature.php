<?php

declare(strict_types=1);

namespace App\Domain\Model;

final readonly class Temperature
{
    private const string TREND_POSITIVE = '🥵';
    private const string TREND_NEGATIVE = '🥶';
    private const string TREND_STATIC = '-';

    public function __construct(
        private float $value,
        private ?float $averageLast10Days = null
    ) {
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getTrend(): string
    {
        if ($this->averageLast10Days === null) {
            return self::TREND_STATIC;
        }

        if ($this->value > $this->averageLast10Days) {
            return self::TREND_POSITIVE;
        }

        if ($this->value < $this->averageLast10Days) {
            return self::TREND_NEGATIVE;
        }

        return self::TREND_STATIC;
    }

    public function format(): string
    {
        return sprintf('%d %s', $this->value, $this->getTrend());
    }
}
