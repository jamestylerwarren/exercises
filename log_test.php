<?php
require_once 'Log.php';

$logger = new Log('cli');

$message = 'This is a test';
$logger->logInfo($message);
$logger->logError($message);