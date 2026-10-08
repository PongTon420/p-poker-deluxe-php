<?php

namespace RinTohsaka\Objects;

class Card {
        private string $suit;
        private string $rank;
        function __construct($suit, $rank) {
                $this->suit = $suit;
                $this->rank = $rank;
        }

        public function displayCard(): void
        {
                echo $this->rank . " of " . $this->suit;
        }
}