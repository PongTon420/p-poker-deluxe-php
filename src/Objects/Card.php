<?php

namespace RinTohsaka\Objects;

class Card {
        private string $suit;
        private string $rank;

        private int $score;

        function __construct($suit, $rank, $score) {
                $this->suit = $suit;
                $this->rank = $rank;
                $this->score = $score;
        }

        public function displayCard(): void
        {
                echo $this->rank . " of " . $this->suit;
        }

        public function getRank(): string {
                return $this->rank;
        }
        public function getSuit(): string {
                return $this->suit;
        }

        public function getScore(): int {
                return $this->score;
        }
}