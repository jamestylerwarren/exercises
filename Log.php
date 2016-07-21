<?php

class Log
{
	public $filename;

	function logMessage($logLevel, $message) {
		$date = date('Y-m-d');
		$time = date('h-i-s');
		$this->filename = "log-{$date}.log";
		$handle = fopen($this->filename, 'a');
		fwrite($handle, $date . ' ' . $time . ' ' . $logLevel . ' ' . $message . PHP_EOL);
		fclose($handle);
	} 

	function logInfo($message) {	
		$this->logMessage ('INFO', $message);
	}

	function logError($message) {
		$this->logMessage('ERROR', $message);
	}
}

