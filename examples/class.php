<?php declare(strict_types=1);
use JBuncle\Logging\Logger;
use JBuncle\Logging\LoggerFactories\ErrorLogLoggerFactory;
use Psr\Log\LogLevel;

require __DIR__ . '/../vendor/autoload.php';

class MyClass {

    private $logger;

    function __construct() {
        $this->logger = Logger::getLogger(['class' => self::class]);
    }

    function iDoSomething(string $myParam): void {
        $this->logger->log(LogLevel::DEBUG, 'About to do something', ['myParam' => $myParam]);
        // Code that does stuff
        $this->logger->log(LogLevel::INFO, 'Did something');
    }

    function iAlsoDoSomething(string $myParam): void {
        $this->logger->debug('About to do something', ['myParam' => $myParam]);
        // Code that does stuff
        $this->logger->info('Did something');
    }

}

// Setup the logger
$loggerFactory = new ErrorLogLoggerFactory();
$logger = $loggerFactory->createLogger();
Logger::setLogger($logger);

// Use it
$class = new MyClass();
$class->iDoSomething('like what');
