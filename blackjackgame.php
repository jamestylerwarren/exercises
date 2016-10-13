<?php

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
	if ($bankroll <= 0) {
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
		if ($total > 21 && cardIsAce($value['card'])) {
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

//echo bankroll
function echoBankroll($bankroll) {
	echo 'Bankroll = $' . $bankroll . '.' . PHP_EOL;
}

//called when player hits (takes a card)
function playerHit($name, $deck, $player, $dealer, $bet, $insuranceBet, $bankroll){
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
		evaluateHands($name, $player, $dealer, $bet, $insuranceBet, $bankroll);
	}
	return $player;
}

function dealerHit ($deck, $dealer){
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
	return $dealer;
}


//allow player ability to double down 
function doubleDown($name, $deck, $player, $dealer, $insuranceBet, $deck, $bet, $bankroll) {
	if ($bankroll >= ($bet*2)) {
		fwrite(STDOUT, "Would you like to double down? (y)es or (n)o? ") . PHP_EOL;
		$doubleDown = strtolower(trim(fgets(STDIN)));
		if ($doubleDown == 'y') {
			$bet = ($bet*2);
			echo "Ok you doubled your wager to $" . $bet . '.' . PHP_EOL;
			//hit with only one more card and evaluate (if player>21, evaluate hand)
			$player = playerHit($name, $deck, $player, $dealer, $bet, $insuranceBet, $bankroll);
			//play out dealer hand
			echoDealer($dealer, false);
			$dealer = dealerHit ($deck, $dealer);
			//evaluate result
			evaluateHands($name, $player, $dealer, $bet, $insuranceBet, $bankroll);
		}
	} 
}

//allow player to take insurance
function playerInsurance($name, $dealer, $bet, $bankroll) {
	//if card showing is an Ace, ask player if they want insurance
	if ($dealer[0]['card'] == 'Ace') {
		fwrite(STDOUT, "Do you want insurance? (y)es or (n)o? ") . PHP_EOL;
		$choice = strtolower(trim(fgets(STDIN)));
		//if player wants insurance
		if ($choice == 'y') {
			$insuranceBet = enterBet($bankroll);
			//if hole card has a value of 10
			if (getCardValue($dealer[1]['card']) == 10) {
				//echo dealer hand and end the end
				echoDealer($dealer, $hidden = false);
				$bankroll += (2 * $insuranceBet);
				$bankroll -= $bet;
				echo 'Dealer has blackjack! ' . PHP_EOL;
				echoBankroll($bankroll);
				echo '---------------------------------------------------' . PHP_EOL;
				playAgain($name, $bankroll, $bet);
			} else {
				echo "Dealer doesn't have blackjack." . PHP_EOL;
				return $insuranceBet;
			}
		}
	}
}

// //allow ability to split hand
function splitCards($player, $dealer, $name, $insuranceBet, $bankroll, $bet, $deck) {
	//if two cards are same value and ($bankroll >= ($bet*2)), ask if they want to split cards
	if (getCardValue($player[0]['card']) == getCardValue($player[1]['card']) && $bankroll >= ($bet*2)) {
		fwrite(STDOUT, 'Do you want to split your hand? (y)es or (n)o? ') . PHP_EOL;
		$choice = strtolower(trim(fgets(STDIN)));
		if ($choice == 'y') {
			//create two hands, both of which contain one of the cards from previous hand, both with the assigned bet
				//draw a card to each new hand
			$firstSplitHandCardOne = $player[0];
			$firstSplitHand[] = $firstSplitHandCardOne;
			$firstSplitHandCardTwo = drawACard($deck);
			$firstSplitHand[] = $firstSplitHandCardTwo;
			$firstSplitHandBet = $bet;
			echoPlayer($firstSplitHand, $name);
			while (getTotal($firstSplitHand) < 22) {
				fwrite(STDOUT, "(H)it or (S)tay? ") . PHP_EOL;
				$decision = strtolower(trim(fgets(STDIN)));
				//Stay option
				if ($decision == 's') {
					echoDealer($dealer, false);
					$dealer = dealerHit ($deck, $dealer);
					//Evaluate Hands
					//evaluate if dealer busts
					if (getTotal($dealer) > 21) {
						$bankroll += $firstSplitHandBet;
						$bankroll -= $insuranceBet;
						echo 'Dealer busted!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
						//stop from proceeding to next if-block by calling playAgain
						break;
					}
					//evaluate if player busts
					if (getTotal($firstSplitHand) > 21) {
						$bankroll -= $firstSplitHandBet;
						$bankroll -= $insuranceBet;
						echo $name . ' busted! Dealer wins.' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
						//stop from proceeding to next if-block by calling playAgain
						break;
					}
					if (getTotal($firstSplitHand) == getTotal($dealer)) {
						echo $name . ' and Dealer push!' . PHP_EOL;
						$bankroll -= $insuranceBet;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					} elseif (getTotal($firstSplitHand) > getTotal($dealer)) {
						$bankroll += $firstSplitHandBet;
						$bankroll -= $insuranceBet;
						echo $name . ' wins!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					} elseif (getTotal($firstSplitHand) < getTotal($dealer)) {
						$bankroll -= $firstSplitHandBet;
						$bankroll -= $insuranceBet;
						echo 'Dealer wins!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					}
				//Hit option
				} elseif ($decision == 'h') {
					$newCard = drawACard($deck);
					$firstSplitHand[] = $newCard;
					$total = getTotal($firstSplitHand);
					//echo out each card and total
					foreach ($firstSplitHand as $card) {
						echo '[' . $card['card'] . ' ' . $card['suit'] . '] ';
					}
					echo $name . ' total = ' . $total . PHP_EOL;
					//notify when player busts
					if (getTotal($firstSplitHand) > 21) {
						$bankroll -= $firstSplitHandBet;
						$bankroll -= $insuranceBet;
						echo $name . ' busted! Dealer wins.' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					}
					return $firstSplitHand;
				}
			}

			$secondSplitHandCardOne = $player[1];
			$secondSplitHand[] = $secondSplitHandCardOne;
			$secondSplitHandCardTwo = drawACard($deck);
			$secondSplitHand[] = $secondSplitHandCardTwo;
			$secondSplitHandBet = $bet;
			echoPlayer($secondSplitHand, $name);
			while (getTotal($secondSplitHand) < 22) {
				fwrite(STDOUT, "(H)it or (S)tay? ") . PHP_EOL;
				$decision = strtolower(trim(fgets(STDIN)));
				//Stay option
				if ($decision == 's') {
					echoDealer($dealer, false);
					$dealer = dealerHit ($deck, $dealer);
					//Evaluate Hands
					//evaluate if dealer busts
					if (getTotal($dealer) > 21) {
						$bankroll += $secondSplitHandBet;
						echo 'Dealer busted!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
						//stop from proceeding to next if-block by calling playAgain
						break;
					}
					//evaluate if player busts
					if (getTotal($secondSplitHand) > 21) {
						$bankroll -= $secondSplitHandBet;
						echo $name . ' busted! Dealer wins.' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
						//stop from proceeding to next if-block by calling playAgain
						break;
					}
					if (getTotal($secondSplitHand) == getTotal($dealer)) {
						echo $name . ' and Dealer push!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					} elseif (getTotal($secondSplitHand) > getTotal($dealer)) {
						$bankroll += $secondSplitHandBet;
						echo $name . ' wins!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					} elseif (getTotal($secondSplitHand) < getTotal($dealer)) {
						$bankroll -= $secondSplitHandBet;
						echo 'Dealer wins!' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					}
				//Hit option
				} elseif ($decision == 'h') {
					$newCard = drawACard($deck);
					$secondSplitHand[] = $newCard;
					$total = getTotal($secondSplitHand);
					//echo out each card and total
					foreach ($secondSplitHand as $card) {
						echo '[' . $card['card'] . ' ' . $card['suit'] . '] ';
					}
					echo $name . ' total = ' . $total . PHP_EOL;
					//notify when player busts
					if (getTotal($secondSplitHand) > 21) {
						$bankroll -= $secondSplitHandBet;
						echo $name . ' busted! Dealer wins.' . PHP_EOL;
						echoBankroll($bankroll);
						echo '---------------------------------------------------' . PHP_EOL;
					}
					return $secondSplitHand;
				}
			}
		}
	}
}

function hitOrStay($name, $deck, $player, $dealer, $bet, $insuranceBet, $bankroll) {
	while (getTotal($player) < 22) {
		fwrite(STDOUT, "(H)it or (S)tay? ") . PHP_EOL;
		$decision = strtolower(trim(fgets(STDIN)));
		//Stay option
		if ($decision == 's') {
			echoDealer($dealer, false);
			$dealer = dealerHit ($deck, $dealer);
			//Evaluate Hands
			evaluateHands($name, $player, $dealer, $bet, $insuranceBet, $bankroll);
		//Hit option
		} elseif ($decision == 'h') {
			$player = playerHit($name, $deck, $player, $dealer, $bet, $insuranceBet, $bankroll);
		}
	}
}

//Evaluate Hands
function evaluateHands($name, $player, $dealer, $bet, $insuranceBet, $bankroll) {
	//evaluate if dealer busts
	if (getTotal($dealer) > 21) {
		$bankroll += $bet;
		$bankroll -= $insuranceBet;
		echo 'Dealer busted!' . PHP_EOL;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
		//stop from proceeding to next if-block by calling playAgain
		playAgain($name, $bankroll, $bet);
	}
	//evaluate if player busts
	if (getTotal($player) > 21) {
		$bankroll -= $bet;
		$bankroll -= $insuranceBet;
		echo $name . ' busted! Dealer wins.' . PHP_EOL;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
		//stop from proceeding to next if-block by calling playAgain
		playAgain($name, $bankroll, $bet);
	}
	if (getTotal($player) == getTotal($dealer)) {
		echo $name . ' and Dealer push!' . PHP_EOL;
		$bankroll -= $insuranceBet;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
	} elseif (getTotal($player) > getTotal($dealer)) {
		$bankroll += $bet;
		$bankroll -= $insuranceBet;
		echo $name . ' wins!' . PHP_EOL;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
	} elseif (getTotal($player) < getTotal($dealer)) {
		$bankroll -= $bet;
		$bankroll -= $insuranceBet;
		echo 'Dealer wins!' . PHP_EOL;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
	}
	playAgain($name, $bankroll, $bet);
}

//check if player has blackjack and end hand if true
function blackjackCheck($name, $player, $bankroll, $bet){
	if (getTotal($player) == 21) {
		$bankroll += ($bet * 1.50);
		echo 'Blackjack!! ' . $name . ' wins $' . ($bet * 1.50) . '!' . PHP_EOL;
		echoBankroll($bankroll);
		echo '---------------------------------------------------' . PHP_EOL;
		playAgain($name, $bankroll, $bet);
	}
}

//sets up game - builds deck, takes player name, bankroll, initial bet and draws & echos player and dealer hands
function gameSetup() {
	// create an array for cards
	$suits = ['C', 'H', 'S', 'D'];
	$cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];
	//take player name
	$name = enterName();
	//Build the deck of cards
	$deck = buildDeck($cards, $suits);
	// initialize a dealer and player hand
	$dealer = [];
	$player = [];
	$bankroll = determineBankroll();
	$bet = enterBet($bankroll);
	drawHand($deck, $player);
	drawHand($deck, $dealer);
	echoDealer($dealer, true);
	echoPlayer($player, $name);
	gamePlay($deck, $player, $dealer, $name, $bankroll, $bet);
}

function gamePlay($deck, $player, $dealer, $name, $bankroll, $bet) {
	//check if player has blackjack and end hand
	blackjackCheck($name, $player, $bankroll, $bet); 

	//insurance bet?
	$insuranceBet = playerInsurance($name, $dealer, $bet, $bankroll);

	//split option here
	splitCards($player, $dealer, $name, $insuranceBet, $bankroll, $bet, $deck);

	//double down option
	doubleDown($name, $deck, $player, $dealer, $insuranceBet, $deck, $bet, $bankroll);

	//player must select (H)it or (S)tay
	hitOrStay($name, $deck, $player, $dealer, $bet, $insuranceBet, $bankroll);
}
function playAgain($name, $bankroll, $bet) {
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
		$suits = ['C', 'H', 'S', 'D'];
		$cards = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];
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
//function that starts game;
gameSetup($cards, $suits);






