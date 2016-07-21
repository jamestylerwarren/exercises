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


//this function draws a random card from the deck and returns it. Also takes the card out of the deck
function drawACard(&$deck) {
	$randomKey = array_rand($deck);
	$randomCard = $deck[$randomKey];
	unset($deck[$randomKey]);
	return $randomCard;
} 

//this function gets the value of a card drawn out of the deck
function getCardValue($card) {
	if ($card == 'Ace') {
		return 11;
	} elseif ($card == 'Jack' || $card == 'Queen' || $card == 'King') {
		return 10;
	} else {
		return intval($card);
	}
} 

//this function evaluates whether the card is an ace or not.
function cardIsAce($card) {
	if ($card == 'Ace') {
		return true;
	} 
		return false;
} 



//this function will get the total for a hand of cards using the getCardValue and cardIsAce functions
function getTotal($hand) {
	$total = 0;
	foreach ($hand as $card => $value) {
		print_r($value);
		$total += getCardValue($card);
		$ace = cardIsAce($card);
		if ($total > 21 && $ace) {
			$total = $total - 10;
		}
	}
	return $total;
} 

$deck = buildDeck($cards, $suits);

$dealer = [];
$player = [];


//this function draws two cards and puts them into an array
function drawCard(&$deck, &$hand) {
	$cardOne = drawACard($deck);
	$hand[] = $cardOne;
	$cardTwo = drawACard($deck);
	$hand[] = $cardTwo;
	return $hand;
} 



fwrite(STDOUT, "Enter name: ") . PHP_EOL;
	$name = trim(fgets(STDIN));



function echoHand(&$hand, $name, $hidden = false) {
	$total = getTotal($hand);
	echo $name . ': [' . $hand[0]['card'] . ' ' . $hand[0]['suit'] . '] [' . $hand[1]['card'] . ' ' . $hand[1]['suit'] . '] TOTAL= ' . $total . PHP_EOL;
} 
// echoHand($player, $name);
drawCard($deck, $player);
print_r(getTotal($player));











