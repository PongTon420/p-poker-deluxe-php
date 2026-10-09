<?php

namespace RinTohsaka;

class Magecraft
{
        private static array $straightTable = [
                        "142345" => 1,
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

                if ($scores[6] == 14 && $scores[0] == 2) {
                        // move 14 to front
                        array_unshift($scores, array_pop($scores));
                        // same above logic
                        if (isset(self::$straightTable[implode('', array_slice($scores, 0, 5))])) {
                                return true;
                        }
                } // check 142345

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

        public static function countScoreDupesDescOrder(array $cards) : array
        {
                $scores = null;
                foreach ($cards as $card) {
                        $scores[] = $card->getScore();
                }
                $arrCountDupes = array_count_values($scores);
                arsort($arrCountDupes);
                return $arrCountDupes;
                /*
                 * return Output:
                 * Array = [
                 *              score:2 => frequency: 3
                 *              score:4 => frequency: 2 <- Desc order
                 *              score:14 => frequency: 1
                 *              ...
                 * ] Desc order of frequency
                 * */
        }

        public static function isAnyOfAKind(array $cards, int $kindNumber) : bool
        {
                // For 4OfAKind, 3OfAKind, Pair
                $scoreDupesDescOrder = self::countScoreDupesDescOrder($cards);
                $highestCountScore = array_key_first($scoreDupesDescOrder);
                $numberOfCountScore = $scoreDupesDescOrder[$highestCountScore];

                if ($numberOfCountScore == $kindNumber) {
                        return true;
                }

                return false;
        }

        public static function isFullHouse(array $cards) : bool
        {
                // Same 4OfAKind logic but find for 3 and 2
                // Just read 4OfAKind logic for future maintenance
                $scoreDupesDescOrder = self::countScoreDupesDescOrder($cards);
                $numberOfCountScore = $scoreDupesDescOrder[array_key_first($scoreDupesDescOrder)];
                if ($numberOfCountScore == 3) {
                        array_shift($scoreDupesDescOrder);
                        $numberOfCountScore = $scoreDupesDescOrder[array_key_first($scoreDupesDescOrder)];
                        if ($numberOfCountScore == 2) {
                                return true;
                        }
                }

                return false;
        }

        public static function isTwoPairs(array $cards) : bool
        {
                // Same 4OfAKind logic but find for 2 twice
                // Just read 4OfAKind logic for future maintenance
                $scoreDupesDescOrder = self::countScoreDupesDescOrder($cards);
                $numberOfCountScore = $scoreDupesDescOrder[array_key_first($scoreDupesDescOrder)];
                if ($numberOfCountScore == 2) {
                        array_shift($scoreDupesDescOrder);
                        $numberOfCountScore = $scoreDupesDescOrder[array_key_first($scoreDupesDescOrder)];
                        if ($numberOfCountScore == 2) {
                                return true;
                        }
                }

                return false;
        }

        public static function computeHand(?array $handCards, array$communityCards) : string
        {
                // always choose the best hand
                // this function does not consider when players result in a draw
                // that case will be a TODO: for future PongTon's unlimited php works
                $bestHand = "High card";

                $cards = array_merge($handCards, $communityCards);

                if (self::isFlush($cards) && self::isStraight($cards)) {
                        $bestHand = "Straight flush";
                }
                else if (self::isAnyOfAKind($cards, 4)) {
                        $bestHand = "Four of a kind";
                }
                else if (self::isFullHouse($cards)) {
                        $bestHand = "Full house";
                }
                else if (self::isFlush($cards)) {
                        $bestHand = "Flush";
                }
                else if (self::isStraight($cards)) {
                        $bestHand = "Straight";
                }
                else if (self::isAnyOfAKind($cards, 3)) {
                        $bestHand = "Three of a kind";
                }
                else if (self::isTwoPairs($cards)) {
                        $bestHand = "Two pairs";
                }
                else if (self::isAnyOfAKind($cards, 2)) {
                        $bestHand = "Pair";
                }

                return $bestHand;
        }
}