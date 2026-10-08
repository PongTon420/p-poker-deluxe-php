<?php

namespace RinTohsaka\People;
class Player
{
        private string $name;
        private int $balance;
        private array $cardsInHands;
        private string $currentHandRank;

        public function __construct(string $name)
        {
                $this->name = $name;
        }

        public function getName(): string {
                return $this->name;
        }

        public function setCardsInHands(array $cardsInHands) : void
        {
                $this->cardsInHands = $cardsInHands;
        }
        public function getCardsInHands() : array
        {
                return $this->cardsInHands;
        }
}