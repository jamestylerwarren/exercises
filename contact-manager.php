<?php
//------OPTION NUMBER 1 - VIEWING CONTACTS--------//
function viewContacts() {
	$filename = 'contacts.txt';
	$handle = trim(file_get_contents($filename));
	return $handle . PHP_EOL . PHP_EOL;
}


//------OPTION NUMBER 2 - ADDING CONTACTS--------//
function addContact() {
	$filename = 'contacts.txt';
	$handle = fopen($filename, 'a');
	fwrite(STDOUT, "Enter name: ") . PHP_EOL;
	$newName = trim(fgets(STDIN));
	fwrite(STDOUT, "Enter number: ") . PHP_EOL;
	$newNumber = trim(fgets(STDIN));
	fwrite($handle, PHP_EOL . $newName . '|' . $newNumber);
	fclose($handle);
}


//--------OPTION 3 - SEARCHING THROUGH CONTACTS-------//
function searchContact() {
	$contacts = contactArray();
	$search = [];
	fwrite(STDOUT, "Please enter name: ") . PHP_EOL;
	$searchName = trim(fgets(STDIN));
	foreach ($contacts as $contact) {
		if (stripos($contact['name'], $searchName) !== false) {
			$search[] = $contact;
		} 
	} 
	$searchedName = implode('|', $search[0]);
	return $searchedName . PHP_EOL . PHP_EOL;
} 


//--------OPTION 4 - DELETING CONTACT------------------//
function deleteContact() {
	$contacts = contactArray();
	fwrite(STDOUT, "Please enter name to delete: ") . PHP_EOL;
	$searchName = trim(fgets(STDIN));
	foreach ($contacts as $contact => $info) {
		if (stripos($info['name'], $searchName) !== false) {
			unset($contacts[$contact]);
			continue;
		} 
		$contacts[$contact] = implode("|", $info);
	}
	$contacts = implode("\n", $contacts);
	$filename = 'contacts.txt';
	$handle = fopen($filename, 'w');
	fwrite($handle, $contacts);
	fclose($handle);
}


//--------TURNING LIST OF CONTACTS INTO AN ARRAY----------//
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


// -----------OPTIONS MENU-----------------------------//
function optionMenu() {
	do {
		fwrite(STDOUT, "1. View contacts\n2. Add a new contact\n3. Search a contact by name\n4. Delete an existing contact\n5. Exit\nEnter an option (1, 2, 3, 4 or 5): ") . PHP_EOL . PHP_EOL;
		$startingOption = trim(fgets(STDIN));
		if ($startingOption == 1) {
			echo PHP_EOL . 'Name | Phone Number' . PHP_EOL;
			echo viewContacts();	
		} elseif ($startingOption == 2) {
			 echo addContact();
		} elseif ($startingOption == 3) {
			echo searchContact();
		} elseif ($startingOption == 4) {
			echo deleteContact();;
		} elseif ($startingOption == 5) {
			exit(0);
		} else {
			echo('Please choose a valid option.') . PHP_EOL;
		}

	} while ($startingOption != 5);

} 
echo optionMenu();

