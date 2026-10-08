<?php

namespace RinTohsaka\People;
use RinTohsaka\Magecraft;

class Player
{
        private string $name;
        private int $balance;
        private array $cardsInHands;
        private string $currentHand;

        public function __construct(string $name)
        {
                $this->name = $name;
                $this->currentHand = "";
        }

        public function getName(): string {
                return $this->name;
        }

        public function setCardsInHands(array $cardsInHand) : void
        {
                $this->cardsInHands = $cardsInHand;
        }

        public function getCardsInHands() : array
        {
                return $this->cardsInHands;
        }

        public function getCurrentHand() : string
        {
                return $this->currentHand;
        }

        public function makeHand(array $communityCards) : void {
                $this->currentHand = Magecraft::computeHand($this->cardsInHands, $communityCards);
        }
}