<?php

// Regexp Basics - is it IPv4 address?
// Implement String#ipv4_address?, which should return true if given object is an IPv4 address - four numbers (0-255) separated by dots.

// It should only accept addresses in canonical representation, so no leading 0s, spaces etc

function ipv4_address($address){
	$addressArray = explode(".", $address);
	if (empty($address) || ctype_space($address) || count($addressArray) != 4) {
		return false;
	}
	foreach ($addressArray as $number) {
		if (!ctype_digit($number)) {
			return false;
		}
	}
	return true;
}

$address = "127.0.0.1";
var_dump(ipv4_address($address));
