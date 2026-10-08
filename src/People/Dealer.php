<?php

namespace RinTohsaka\People;

use RinTohsaka\Objects\Deck;
use RinTohsaka\Objects\Card;

class Dealer
{
        private Deck $deck;

        function __construct(Deck $deck)
        {
                $this->deck = $deck;
        }

        public function dealCard(array $players): void
        {
                foreach ($players as $player) {
                        $hand = $this->deck->drawAmountOfCards(2);
                        $player->setCardsInHands($hand);
                }
        }
}