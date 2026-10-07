<?php
require_once "Card.php";
class Deck {
        private array $cards = array();

        public function __construct() {
                $suits = ["Hearts", "Diamonds", "Clubs", "Spades"];
                $ranks = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "Jack", "Queen", "King", "Ace"];

                foreach ($suits as $suit) {
                        foreach ($ranks as $rank) {
                                array_push($this->cards, new card($suit, $rank));
                        }
                }
                shuffle($this->cards);
        }
        public function getCards() : array {
                return $this->cards;
        }

        public function takeTopCard(): Card
        {
                return array_pop($this->cards);
        }
        public function drawAmountOfCards(int $amount) : array {
                $drewCards = array();
                for ($i = 0; $i < $amount; $i++) {
                        $drewCards[] = $this->takeTopCard();
                }
                return $drewCards;
        }
        public function shuffleDeck() : void {
                shuffle($this->cards);
        }
        public function dealCard(array $players, int $total_player) : void {
                for ($i = 0; $i < $total_player; $i++) {
                        $hand = $this->drawAmountOfCards(2);
                        echo "{$players[$i]} <br>";
                        foreach ($hand as $card) {
                                $card->displayCard();
                        }
                        echo "<br>";
                }
        }
}