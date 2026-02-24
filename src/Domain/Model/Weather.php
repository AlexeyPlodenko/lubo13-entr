<?php

declare(strict_types=1);

namespace App\Domain\Model;

final readonly class Weather
{
    public function __construct(
        private City $city,
        private Temperature $temperature
    ) {
    }

    public function getCity(): City
    {
        return $this->city;
    }

    public function getTemperature(): Temperature
    {
        return $this->temperature;
    }
}
