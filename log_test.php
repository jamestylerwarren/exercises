<?php
require_once 'Log.php';

//calling a new Log function, and passing 'cli' to constructor function in LOG
$logger = new Log('cli');

$message = 'This is a test';
$logger->logInfo($message);
$logger->logError($message);