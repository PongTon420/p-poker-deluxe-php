<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
</head>
<body>
        <form action="test.php" method="post">
                <input type="submit" name="submit" value="Deal">
        </form>
</body>
</html>

<?php

require_once __DIR__ . '/vendor/autoload.php';

use RinTohsaka\Objects\Deck;
use RinTohsaka\Objects\Card;
use RinTohsaka\People\Player;
use RinTohsaka\People\Dealer;

$test_player = new Player("TestMan");
$test_hand = array(
        new Card("Hearts", "10", 10),
        new Card("Hearts", "Jack", 11)
        );
$test_player->setCardsInHands($test_hand);
$test_communityCards = array(
        new Card("Hearts", "Queen", 12),
        new Card("Hearts", "King", 13),
        new Card("Hearts", "Ace", 14),
        new Card("Spades", "3", 2),
        new Card("Clubs", "2", 3),
        );
$test_player->makeHand($test_communityCards);
echo "<br>result " . $test_player->getCurrentHand();