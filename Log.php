<?php

class Log
{
	public $filename;
	public $handle;
	public $date; 
	public $time; 

	public function __construct($prefix='log') {
		$this->date = date('Y-m-d');
		$this->time = date('h-i-s'); 
		$this->filename = "{$prefix}-{$this->date}.log";
		$this->handle = fopen($this->filename, 'a');
	}

	function logMessage($logLevel, $message) {
		fwrite($this->handle, $this->date . ' ' . $this->time . ' ' . $logLevel . ' ' . $message . PHP_EOL);
	} 

	function logInfo($message) {	
		$this->logMessage ('INFO', $message);
	}

	function logError($message) {
		$this->logMessage('ERROR', $message);
	}

	public function __destruct(){
		fclose($this->handle);
	}
}

