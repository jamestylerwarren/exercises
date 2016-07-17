<?php

// complete all "todo"s to build a blackjack game
$suits = ['C', 'H', 'S', 'D'];
// create an array for cards
$cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];


//this function builds a deck of cards from the $suits and $cards array, shuffles and returns the deck
function buildDeck($cards, $suits) {
	$deck = [];
	foreach ($suits as $suit) {
		foreach ($cards as $card) {
			$deck[] = ['card' => $card, 'suit' => $suit];
		}
	}
	shuffle($deck);
	return $deck;
} 


//this function draws a random card from the deck
function drawCard($cards, $suits) {
	$deck = buildDeck($cards, $suits);
	$randomKey = array_rand($deck);
	$randomCard = $deck[$randomKey];
	return $randomCard;
} 


//this function gets the value of a card drawn out of the deck
function getValue($cards, $suits) {
	$randomCard = drawCard($cards, $suits);
	$randomCardValue = $randomCard['card'];
	print_r($randomCardValue);
	if ($randomCardValue == 'Ace') {
		return 11;
	} elseif ($randomCardValue == 'Jack' || $randomCardValue == 'Queen' || $randomCardValue == 'King') {
		return 10;
	} else {
		return intval($randomCardValue);
	}
} 

