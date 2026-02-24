<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Service\GetWeatherService;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    public function __construct(
        private readonly GetWeatherService $getWeatherService
    ) {
    }

    #[Route('/weather/{city}', name: 'app_weather', methods: ['GET'])]
    public function __invoke(string $city): JsonResponse
    {
        try {
            $weather = $this->getWeatherService->execute($city);

            return new JsonResponse([
                'city' => $weather->getCity()->getName(),
                'temperature' => $weather->getTemperature()->format(),
            ]);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (Exception) {
            return new JsonResponse(['error' => 'An unexpected error occurred'], 500);
        }
    }
}
