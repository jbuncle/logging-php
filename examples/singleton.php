<?php declare(strict_types=1);
use JBuncle\Logging\Logger;
use JBuncle\Logging\LoggerFactories\ErrorLogLoggerFactory;

require __DIR__ .  '/../vendor/autoload.php';

// Setup the logger
$loggerFactory = new ErrorLogLoggerFactory();
$logger = $loggerFactory->createLogger();
Logger::setLogger($logger);

// Use it
Logger::debug("I'm debugging");
