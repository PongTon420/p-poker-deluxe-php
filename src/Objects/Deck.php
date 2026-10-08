<?php

namespace RinTohsaka\Objects;

class Deck
{
        private array $cards = array();

        public function __construct()
        {
                $suits = ["Hearts", "Diamonds", "Clubs", "Spades"];
                $ranks = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King", "Ace"];

                foreach ($suits as $suit) {
                        foreach ($ranks as $rank) {
                                array_push($this->cards, new Card($suit, $rank));
                        }
                }
                shuffle($this->cards);
        }

        public function takeTopCard(): Card
        {
                return array_pop($this->cards);
        }

        public function drawAmountOfCards(int $amount): array
        {
                $drewCards = array();
                for ($i = 0; $i < $amount; $i++) {
                        $drewCards[] = $this->takeTopCard();
                }
                return $drewCards;
        }
}