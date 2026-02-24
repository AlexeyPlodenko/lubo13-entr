<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Model\City;

interface WeatherProviderInterface
{
    /**
     * @return float Current temperature for the city
     */
    public function getCurrentTemperature(City $city): float;

    /**
     * @return float[] Last 10 days temperatures for the city
     */
    public function getHistoricalTemperatures(City $city): array;
}
