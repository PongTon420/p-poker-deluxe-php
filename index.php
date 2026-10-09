<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pのポーカーデラックス</title>
</head>
<body>
        <form action="index.php" method="post">
                <input type="submit" name="submit" value="Deal">
        </form>
</body>
</html>

<?php

require_once __DIR__ . '/vendor/autoload.php';

use RinTohsaka\Objects\Deck;
use RinTohsaka\People\Player;
use RinTohsaka\People\Dealer;

if (isset($_POST["submit"])) {
        $deck = new Deck();
        $dealer = new Dealer($deck);
        $players = array(new Player("PongTon"), new Player("Deng"));
        $dealer->dealCard($players);
        $communityCards = $deck->drawAmountOfCards(5);
        foreach ($communityCards as $card) {
                echo $card->displayCard() . "<br>";
        }
        echo "<br>";
        foreach ($players as $player) {
                echo $player->makeHand($communityCards);
                echo $player->getName() . ": " . $player->getCurrentHand() . "<br>";
                foreach ($player->getCardsInHands() as $card) {
                        echo $card->displayCard() . "<br>";
                }
                echo "<br>";
        }
}