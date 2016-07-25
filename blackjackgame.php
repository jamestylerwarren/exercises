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
		$total += getCardValue($value['card']);
		if ($total > 21 && cardIsAce($card)) {
			$total = $total - 10;
		}
	}
	return $total;
} 


//Build the deck of cards
$deck = buildDeck($cards, $suits);
// initialize a dealer and player hand
$dealer = [];
$player = [];


//this function draws two cards and puts them into an array - $player or $dealer
function drawHand(&$deck, &$hand) {
	$cardOne = drawACard($deck);
	$hand[] = $cardOne;
	$cardTwo = drawACard($deck);
	$hand[] = $cardTwo;
	return $hand;
} 


//ask for player name
fwrite(STDOUT, "Enter name: ") . PHP_EOL;
	$name = trim(fgets(STDIN));


//echo out player's hand and total
function echoPlayer(&$player, $name, $hidden = false) {
	$total = getTotal($player);
	echo $name . ': [' . $player[0]['card'] . ' ' . $player[0]['suit'] . '] [' . $player[1]['card'] . ' ' . $player[1]['suit'] . '] TOTAL= ' . $total . PHP_EOL;

} 

function echoDealer(&$dealer, $hidden = false) {
	$total = $total = getTotal($dealer);
	if ($hidden) {
		echo 'Dealer: [' . $dealer[0]['card'] . ' ' . $dealer[0]['suit'] . '] [???] TOTAL= ???' . PHP_EOL;
	}
}

drawHand($deck, $player);
drawHand($deck, $dealer);
echoPlayer($player, $name, false);
echoDealer($dealer, true);


//ask player to (H)it or (S)tay
fwrite(STDOUT, "(H)it or (S)tay? ") . PHP_EOL;
	$decision = trim(fgets(STDIN));
	$decision = strtolower($decision);


//while player selects hit:
while ($decision == 'h') {
	$newCard = drawACard($deck);
	$player[] = $newCard;
	echoPlayer($player, $name, $hidden = false);
}










