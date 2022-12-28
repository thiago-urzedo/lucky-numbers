<?php

require __DIR__ . '/../vendor/autoload.php';

$nGames        = 7;
$nOnEachGame   = 6;
$repeatNumbers = true;

$ln = new Urzedo\OffTopic\MegaSena($nGames, $nOnEachGame, $repeatNumbers);
$ln->start();
