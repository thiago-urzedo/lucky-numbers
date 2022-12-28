<?php

namespace Urzedo\OffTopic;

class MegaSena extends Game
{
    private array $prices = [
        6  => 4.50,
        7  => 31.50,
        8  => 126.00,
        9  => 378.00,
        10 => 945,00,
        11 => 2079.00,
        12 => 4158.00,
        13 => 7722.00,
        14 => 13513.50,
        15 => 22522.50,
        16 => 36036.00,
        17 => 55692.00,
        18 => 83538.00,
        19 => 122094.00,
        20 => 174420.00,
    ];

    public function __construct(int $nGames = 7, int $nOnEachGame = 6, bool $repeatNumbers = true)
    {
        parent::__construct();
        $this->setNGames($nGames);
        $this->setNOnEachGame($nOnEachGame);
        $this->setRepeatNumbers($repeatNumbers);
    }

    public final function start($printMode = 1): void
    {
        $this->printParams();
        $this->generateGames();
        $this->calcTotalPrice();
        $this->printResult();
    }

    protected function generateGames(): void
    {
        for ($i = 0; $i < $this->getNGames(); $i++) {
            $game = $this->generateSingleGame();
            $price = $this->prices[$this->getNOnEachGame()];

            $this->addCardToGame($game, $price);
        }
    }

    private function generateSingleGame(): array
    {
        $game = [];
        while (count($game) < $this->getNOnEachGame()) {
            $randNumber = $this->getRandomInt(1, 60);
            if (in_array($randNumber, $game)) {
                continue;
            }
            $game[] = $randNumber;
        }
        asort($game);
        return $game;
    }

    private function printParams()
    {
        echo "\n===================================================\n";
        echo "                ".mb_chr(9752, 'UTF-8')." Mega Sena ".mb_chr(9752, 'UTF-8')."\n";
        echo "===================================================\n\n";
        echo "Gerando {$this->getNGames()} jogos, com {$this->getNOnEachGame()} números em cada jogo.";
        if ($this->getRepeatNumbers()) {
            echo " Pode haver números iguais em jogos diferentes.\n\n";
        } else {
            echo " Não haverá números iguais em jogos diferentes.\n\n";
        }
    }

    protected function setNOnEachGame(int $nOnEachGame): void
    {
        if ($nOnEachGame < 6) {
            echo "Quantidade de números por jogos inválida ({$nOnEachGame}). Quantidade foi ajustado para 6.\n";
            $nOnEachGame = 6;
        }

        if ($nOnEachGame > 20) {
            echo "Quantidade de números por jogos inválida ({$nOnEachGame}). Quantidade foi ajustado para 20.\n";
            $nOnEachGame = 20;
        }

        parent::setNOnEachGame($nOnEachGame);
    }

}