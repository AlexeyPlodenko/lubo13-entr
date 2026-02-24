<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Model;

use App\Domain\Model\Temperature;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class TemperatureTest extends TestCase
{
    #[DataProvider('trendProvider')]
    public function testGetTrend(float $value, ?float $avg, string $expectedTrend): void
    {
        $temperature = new Temperature($value, $avg);
        $this->assertEquals($expectedTrend, $temperature->getTrend());
    }

    public static function trendProvider(): array
    {
        return [
            'positive trend' => [10.0, 5.0, '🥵'],
            'negative trend' => [5.0, 10.0, '🥶'],
            'static trend' => [10.0, 10.0, '-'],
            'no historical data' => [10.0, null, '-'],
        ];
    }

    public function testFormat(): void
    {
        $temperature = new Temperature(4.0, 3.0);
        $this->assertEquals('4 🥵', $temperature->format());
    }
}
