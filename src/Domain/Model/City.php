<?php

declare(strict_types=1);

namespace App\Domain\Model;

final readonly class City
{
    public function __construct(private string $name)
    {
        if (empty($this->name)) {
            throw new \InvalidArgumentException('City name cannot be empty');
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
