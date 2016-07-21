<?php

class Log
{	//defining variables
	public $filename;
	public $handle;
	public $date; 
	public $time; 


	//constructor function performs from the start
	//constructor function defines variables and opens the file
	public function __construct($prefix='log') {
		$this->date = date('Y-m-d');
		$this->time = date('h-i-s'); 
		$this->filename = "{$prefix}-{$this->date}.log";
		$this->handle = fopen($this->filename, 'a');
	}

	//logMessage writes in the file
	function logMessage($logLevel, $message) {
		fwrite($this->handle, $this->date . ' ' . $this->time . ' ' . $logLevel . ' ' . $message . PHP_EOL);
	} 

	function logInfo($message) {	
		$this->logMessage ('INFO', $message);
	}

	function logError($message) {
		$this->logMessage('ERROR', $message);
	}

	//destruct function runs at the very end, closing the file
	public function __destruct(){
		fclose($this->handle);
	}
}

