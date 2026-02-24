<?php

declare(strict_types=1);

namespace App\Infrastructure\ExternalApi;

use App\Domain\Model\City;
use App\Domain\Repository\WeatherProviderInterface;

final class MockWeatherProvider implements WeatherProviderInterface
{
    public function getCurrentTemperature(City $city): float
    {
        if ($city->getName() === 'Sofia') {
            return 4.0;
        }

        return (float) rand(0, 30);
    }

    public function getHistoricalTemperatures(City $city): array
    {
        if ($city->getName() === 'Sofia') {
            return [3.0, 2.0, 4.0, 3.0, 2.0, 4.0, 3.0, 2.0, 4.0, 3.0];
        }

        return array_map(fn() => (float) rand(0, 30), range(1, 10));
    }
}
