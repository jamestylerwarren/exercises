<?php

function viewContacts() {
	$filename = 'contacts.txt';
	$handle = trim(file_get_contents($filename));
	return $handle . PHP_EOL . PHP_EOL;
}


function addContact() {
	$filename = 'contacts.txt';
	$handle = fopen($filename, 'a');
	fwrite(STDOUT, "Please enter contact first and last name: ") . PHP_EOL;
	$newName = trim(fgets(STDIN));
	fwrite(STDOUT, "Please enter contact telephone number: ") . PHP_EOL;
	$newNumber = trim(fgets(STDIN));
	fwrite($handle, PHP_EOL . $newName . '|' . $newNumber);
	fclose($handle);
}

function searchContact() {
	print_r(contactArray());
	
	


} echo searchContact();

function contactArray() {
	$contactsArray = [];
	$filename = 'contacts.txt';
	$handle = trim(file_get_contents($filename));
	$arrayContact = explode("\n", $handle);
		foreach ($arrayContact as $info) {
			$contact = [];
			$contactInfo = explode("|", $info);
			$contact['name'] = $contactInfo[0];
			$contact['number'] = $contactInfo[1];
			$contactsArray[] = $contact;
		}
	return $contactsArray;
} 


function options() {
	do {
		fwrite(STDOUT, "1. View contacts\n2. Add a new contact\n3. Search a contact bby name\n4. Delete an existing contact\n5. Exit\nEnter an option (1, 2, 3, 4 or 5): ") . PHP_EOL . PHP_EOL;
		$startingOption = trim(fgets(STDIN));
		if ($startingOption == 1) {
			echo PHP_EOL . 'Name | Phone Number' . PHP_EOL;
			print_r(viewContacts());	
		} elseif ($startingOption == 2) {
			print_r(addContact());
		} elseif ($startingOption == 3) {
			print_r('Searching contacts....' . PHP_EOL);
		} elseif ($startingOption == 4) {
			print_r('Deleting a contact....' . PHP_EOL);
		} elseif ($startingOption == 5) {
			exit(0);
		} else {
			echo('Please choose a valid option.') . PHP_EOL;
		}

	} while ($startingOption != 5);

} 