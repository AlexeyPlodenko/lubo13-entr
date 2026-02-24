<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Model\City;
use App\Domain\Model\Temperature;
use App\Domain\Model\Weather;
use App\Domain\Repository\WeatherProviderInterface;

final readonly class GetWeatherService
{
    public function __construct(
        private WeatherProviderInterface $weatherProvider
    ) {
    }

    public function execute(string $cityName): Weather
    {
        $city = new City($cityName);

        $currentTemp = $this->weatherProvider->getCurrentTemperature($city);
        $historicalTemps = $this->weatherProvider->getHistoricalTemperatures($city);

        $average = null;
        if (count($historicalTemps) > 0) {
            $average = array_sum($historicalTemps) / count($historicalTemps);
        }

        $temperature = new Temperature($currentTemp, $average);

        return new Weather($city, $temperature);
    }
}
