<?php

namespace RinTohsaka;

class Magecraft
{
        private static array $straightTable = [
                        "234514" => 1,
                        "23456" => 2,
                        "34567" => 3,
                        "45678" => 4,
                        "56789" => 5,
                        "678910" => 6,
                        "7891011" => 7,
                        "89101112" => 8,
                        "910111213" => 9,
                        "1011121314" => 10
                ];
        public static function isStraight(array $cards) : bool
        {
                $scores = array();

                foreach ($cards as $card) {
                        $scores[] = $card->getScore();
                }
                sort($scores);

                for ($i = 0; $i < 3; $i++) {
                        $choose5 = array_slice($scores, $i, 5);
                        $key = implode('', $choose5);
                        if (isset(self::$straightTable[$key])) {
                                return true;
                        }
                }

                return false;
        }

        public static function isFlush(array $cards) : bool
        {
                $suits = null;
                foreach ($cards as $card) {
                        $suits[$card->getSuit()][] = $card;
                }
                foreach ($suits as $suit => $cards) {
                        if (count($cards) > 4) {
                                return true;
                        }
                }
                return false;
        }

        public static function computeHand(?array $handCards, array$communityCards) : string
        {
                $bestHand = "hi";

                $cards = array_merge($handCards, $communityCards);

                if (self::isFlush($cards) && self::isStraight($cards)) {
                        $bestHand = "Straight Flush";
                }
                else if (self::isFlush($cards)) {
                        $bestHand = "Flush";
                }

                return $bestHand;
        }
}