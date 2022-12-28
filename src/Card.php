<?php

namespace Urzedo\OffTopic;

class Card
{
    private array $numbers = [];
    private float $price = 0;

    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    public function addNumber(int $number): void
    {
        $this->numbers[] = $number;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public final function getNumbers(): array
    {
        return $this->numbers;
    }

    public final function getPrice():float
    {
        return $this->price;
    }
}