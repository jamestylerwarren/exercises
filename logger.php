<?php

function logMessage($logLevel, $message) {
	$date = date('Y-m-d');
	$time = date('h-i-s');
	$filename = "log-{$date}.log";
	$handle = fopen($filename, 'a');
	fwrite($handle, $date . ' ' . $time . ' ' . $logLevel . ' ' . $message . PHP_EOL);
	fclose($handle);
} 

logMessage("INFO", "This is an info message.");
logMessage("ERROR", "This is an info message.");


