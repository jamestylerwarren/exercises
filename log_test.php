<?php
require_once 'Log.php';

$logger = new Log();

$message = 'This is a test';
$logger->logInfo($message);
$logger->logError($message);