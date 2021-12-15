# Simple PHP Logging Library

## Class Member with default context

Setting the logger as a member allows the opportunity to provide a default context.

Which means you can provide things like the classname to all log messages that use the instance.

This allows you to do things like filter log output based on namespace.

```php
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

```

Which prints:

```
DEBUG About to do something array (
  'class' => 'MyClass',
  'myParam' => 'like what',
)
INFO Did something array (
  'class' => 'MyClass',
)
```

## Singleton


If you don't want to instantiate the logger on construction, you can use the 
convenience methods:

```php
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
```

Prints:

```
DEBUG I'm debugging
```