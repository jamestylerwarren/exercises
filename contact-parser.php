<?php

function parseContacts($filename) {
	$contacts = [];
	$filename = 'contacts.txt';
	$contents = file_get_contents($filename);
	$contactArray = explode("\n", $contents);
	foreach ($contactArray as $info) { //no need for key in this foreach bc array is not associative
		$contact = [];   //creating new array to hold name and number
		$contactInfo = explode("|", $info); //exploding the string that contains name and number
		$contact['name'] = $contactInfo[0]; // sending name to the previously empty contact array; contactInfo[0] contains name
		
		//Inserting dashes into phone numbers
		$telephoneNumOne = substr($contactInfo[1], 0, 3); //taking first three numbers
		$telephoneNumTwo = substr($contactInfo[1], 3, 3); //taking 3-5 numbers
		$telephoneNumThree = substr($contactInfo[1], 6); //taking number 6+
		$telephoneNumber = "{$telephoneNumOne}-{$telephoneNumTwo}-{$telephoneNumThree}"; //concatenating the pcs with dashes
		$contact['number'] = $telephoneNumber; //sending contact each telephone # with dashes
		$contacts[] = $contact;	//pushing our contact array we just made into the empty contacts array
	}
	return $contacts;
	
}
var_dump(parseContacts('contacts.txt'));







