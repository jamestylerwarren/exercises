<?php




function options() {
	do {
		fwrite(STDOUT, "1. View contacts\n2. Add a new contact\n3. Search a contact bby name\n4. Delete an existing contact\n5. Exit\nEnter an option (1, 2, 3, 4 or 5): ") . PHP_EOL;
		$startingOption = trim(fgets(STDIN));
		if ($startingOption == 1) {
			print_r('Viewing contacts....' . PHP_EOL);	
		} elseif ($startingOption == 2) {
			print_r('Adding a new contact...' . PHP_EOL);
		} elseif ($startingOption == 3) {
			print_r('Searching contacts....' . PHP_EOL);
		} elseif ($startingOption == 4) {
			print_r('Deleting a contact....' . PHP_EOL);
		} elseif ($startingOption == 5) {
			exit(0);
		} else {
			echo('That is not a valid option.') . PHP_EOL;
		}

	} while ($startingOption != 5);

} echo options();