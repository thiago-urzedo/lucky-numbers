<?php

namespace Urzedo\OffTopic;

use Random\Randomizer;

abstract class Game
{
    private Randomizer $randomizer;
    private int $nGames;
    private int $nOnEachGame;
    private int $repeatNumbers;

    private array $retArr = [];
    private float $totalPrice = 0;

    public function __construct()
    {
        $this->randomizer = new Randomizer();
    }

    protected abstract function generateGames(): void;

    protected function getRandomInt(int $min, int $max): int
    {
        if ($min > $max) {
            echo "O número mínimo ({$min}) não pode ser maior que o máximo ({$max}). Os valores serão invertidos.\n";
            $aux = $min;
            $min = $max;
            $max = $aux;
        }
        return $this->randomizer->getInt($min, $max);
    }

    protected function addCardToGame(array $numbers, $price): void
    {
        $card = new Card();
        $card->setNumbers($numbers);
        $card->setPrice($price);
        $this->retArr[] = $card;
    }

    protected function increaseTotalPrice(float $price): void
    {
        $this->totalPrice += $price;
    }

    protected function calcTotalPrice(): void
    {
        foreach ($this->retArr as $card) {
            $this->totalPrice += $card->getPrice();
        }
    }

    protected function printResult():void
    {
        foreach ($this->retArr as $i => $card) {
            $numbers = $card->getNumbers();
            echo sprintf("Jogo %d: ", ($i+1));
            $j = 0;
            foreach ($numbers as $number) {
                echo sprintf("%02d", $number);
                if ($j < count($numbers) - 1) {
                    echo " - ";
                }
                $j++;
            }
            echo "\n";
        }
        echo sprintf("\nPreço total: R$ %01.2f\n\n", $this->getTotalPrice());
    }

    protected function setTotalPrice(float $price): void
    {
        $this->totalPrice = $price;
    }

    protected function setRepeatNumbers(bool $repeatNumbers): void
    {
        $this->repeatNumbers = $repeatNumbers;
    }

    protected function setNGames(int $nGames): void
    {
        if ($nGames < 1) {
            echo "O número de jogos inserido é inválido ({$nGames}). O número de jogos foi ajustado para 1.\n";
            $nGames = 1;
        }

        $this->nGames = $nGames;
    }

    protected function setNOnEachGame(int $nOnEachGame): void
    {
        $this->nOnEachGame = $nOnEachGame;
    }

    protected function getReturn(): array
    {
        return $this->retArr;
    }

    protected final function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    protected final function getNGames(): int
    {
        return $this->nGames;
    }

    protected final function getNOnEachGame(): int
    {
        return $this->nOnEachGame;
    }

    protected final function getRepeatNumbers(): int
    {
        return $this->repeatNumbers;
    }
}