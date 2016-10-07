<?php

// create an array for cards
$suits = ['C', 'H', 'S', 'D'];
$cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];

//ask for player name
function enterName() {
	fwrite(STDOUT, "Enter name: ") . PHP_EOL;
	$name = ucfirst(trim(fgets(STDIN)));
	return $name;
}

// determine player bankroll
function determineBankroll() {
	do {
		fwrite(STDOUT, "Enter your bankroll (table limit = $1,000,000): ") . PHP_EOL;
		$bankroll = trim(fgets(STDIN));
	} while ($bankroll <= 0 || $bankroll > 1000000 || !is_numeric($bankroll));
	return $bankroll;
}

function checkBankroll($bankroll) {
	if ($bankroll == 0) {
		fwrite(STDOUT, "You need to reload your bankroll. ") . PHP_EOL; 
		$bankroll = determineBankroll();
	}
	return $bankroll;
}

// determine bet size
function enterBet($bankroll) {
	do {
		fwrite(STDOUT, "Enter bet: ") . PHP_EOL;
		$bet = trim(fgets(STDIN));
	} while ($bet <= 0 || $bet > $bankroll || !is_numeric($bet));
	return $bet;
}


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

//this function draws two cards and puts them into an array - $player or $dealer
function drawHand(&$deck, &$hand) {
	$cardOne = drawACard($deck);
	$hand[] = $cardOne;
	$cardTwo = drawACard($deck);
	$hand[] = $cardTwo;
	return $hand;
} 

//echo out player's hand and total
function echoPlayer(&$player, $name) {
	$total = getTotal($player);
	echo $name . ': [' . $player[0]['card'] . ' ' . $player[0]['suit'] . '] [' . $player[1]['card'] . ' ' . $player[1]['suit'] . '] TOTAL= ' . $total . PHP_EOL;

} 

//echo dealer hand, hidden during the hand, not hidden otherwise
function echoDealer(&$dealer, $hidden = false) {
	$total = $total = getTotal($dealer);
	if ($hidden) {
		echo 'Dealer: [' . $dealer[0]['card'] . ' ' . $dealer[0]['suit'] . '] [???] TOTAL= ???' . PHP_EOL;
	} else {
		echo 'Dealer: [' . $dealer[0]['card'] . ' ' . $dealer[0]['suit'] . '] [' . $dealer[1]['card'] . ' ' . $dealer[1]['suit'] . '] TOTAL= ' . $total . PHP_EOL;
	}
}

//allow player ability to double down 
function doubleDown($bet, $bankroll) {
	if ($bankroll >= ($bet*2)) {
		fwrite(STDOUT, "Would you like to double down? (y)es or (n)o? ") . PHP_EOL;
		$doubleDown = strtolower(trim(fgets(STDIN)));
		if ($doubleDown == 'y') {
			$bet = ($bet*2);
			echo "Ok you doubled your wager to $" . $bet . '.' . PHP_EOL;
			return $bet;
		} else {
			return $bet;
		}
	} else {
		return $bet;
	}
}

//allow ability to split hand
function splitCards($player, $name, $bankroll, $bet, $deck) {
	//if two cards are same value and ($bankroll >= ($bet*2)), ask if they want to split cards
	if (getCardValue($player[0]['card']) == getCardValue($player[1]['card']) && $bankroll >= ($bet*2)) {
		fwrite(STDOUT, 'Do you want to split your hand? (y)es or (n)o? ') . PHP_EOL;
		$choice = strtolower(trim(fgets(STDIN)));
		if ($choice == 'y') {
			//create two hands, both of which contain one of the cards from previous hand, both with the assigned bet
				//draw a card to each new hand

			$splitHand = [];
			drawHand($deck, $splitHand);
			echoPlayer($splitHand, $name);
			$splitBet = $bet;
			return ['splitHand' => $splitHand, 'splitBet' => $splitBet];
		}
	}
}



function gameSetup($cards, $suits) {
	//Build the deck of cards
	$deck = buildDeck($cards, $suits);
	// initialize a dealer and player hand
	$dealer = [];
	$player = [];
	$name = enterName();
	$bankroll = determineBankroll();
	$bet = enterBet($bankroll);
	drawHand($deck, $player);
	drawHand($deck, $dealer);
	echoDealer($dealer, true);
	echoPlayer($player, $name);
	gamePlay($deck, $player, $dealer, $name, $bankroll, $bet);
}	



function gamePlay($deck, $player, $dealer, $name, $bankroll, $bet) {
	//tell player if they hit blackjack
	if (getTotal($player) == 21) {
		$bankroll += ($bet * 1.50);
		echo 'Blackjack!! ' . $name . ' wins $' . ($bet * 1.50) . '!' . PHP_EOL;
		echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
		playAgain($name, $bankroll, $bet);
	}
	//split option here
	// splitCards($player, $name, $bankroll, $bet, $deck);

	//double down option
	$bet = doubleDown($bet, $bankroll);

	//player must select (H)it or (S)tay
	while (getTotal($player) < 22) {
		fwrite(STDOUT, "(H)it or (S)tay? ") . PHP_EOL;
		$decision = strtolower(trim(fgets(STDIN)));
		//Stay option
		if ($decision == 's') {
			echoDealer($dealer, false);
			while (getTotal($dealer) < 17) {
				$newCard = drawACard($deck);
				$dealer[] = $newCard;
				$total = getTotal($dealer);
				//echo out each card and total
				foreach ($dealer as $card) {
					echo '[' . $card['card'] . ' ' . $card['suit'] . '] ';
				}
				echo 'Dealer total = ' . $total . PHP_EOL;
				}
				//notify when dealer busts
				if (getTotal($dealer) > 21) {
					$bankroll += $bet;
					echo 'Dealer busted! ' . $name . ' wins $' . $bet . '!' . PHP_EOL;
					echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
					playAgain($name, $bankroll, $bet);
			}
			//Evaluate Hands
			if (getTotal($player) == getTotal($dealer)) {
				echo $name . ' and Dealer push! Bankroll still at ' . $bankroll . '.' . PHP_EOL;
			} elseif (getTotal($player) > getTotal($dealer)) {
				$bankroll += $bet;
				echo $name . ' wins ' . $bet . PHP_EOL;
				echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
			} elseif (getTotal($player) < getTotal($dealer)) {
				$bankroll -= $bet;
				echo 'Dealer wins! ' . $name . ' loses ' . $bet . '!' . PHP_EOL;
				echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
			}
			playAgain($name, $bankroll, $bet);

		//Hit option
		} elseif ($decision == 'h') {
			$newCard = drawACard($deck);
			$player[] = $newCard;
			$total = getTotal($player);
			//echo out each card and total
			foreach ($player as $card) {
				echo '[' . $card['card'] . ' ' . $card['suit'] . '] ';
			}
			echo $name . ' total = ' . $total . PHP_EOL;
			//notify when player busts
			if (getTotal($player) > 21) {
				$bankroll -= $bet;
				echo $name . ' busted! Dealer wins.' . PHP_EOL;
				echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
				playAgain($name, $bankroll, $bet);
			}
		}
	}
}

function playAgain($name, $bankroll, $bet) {
	$suits = ['C', 'H', 'S', 'D'];
	$cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];
	fwrite(STDOUT, "Do you want to play again " . $name . "? (y)es or (n)o? ") . PHP_EOL;
	$choice = strtolower(trim(fgets(STDIN)));
	while ($choice == 'y') {
		//check player bankroll
		$bankroll = checkBankroll($bankroll);
		echo "Okay, shuffle up and deal!" . PHP_EOL;
		echo "Bankroll = $" . $bankroll . '.' . PHP_EOL;
		//determine bet size
		$bet = enterBet($bankroll);
		//Build the deck of cards
		$deck = buildDeck($cards, $suits);
		// initialize a dealer and player hand
		$dealer = [];
		$player = [];
		drawHand($deck, $player);
		drawHand($deck, $dealer);
		echoDealer($dealer, true);
		echoPlayer($player, $name);
		gamePlay($deck, $player, $dealer, $name, $bankroll, $bet);
	}
	echo "Ok, thanks for playing " . $name . "!" . PHP_EOL;
	exit();
}

gameSetup($cards, $suits);






