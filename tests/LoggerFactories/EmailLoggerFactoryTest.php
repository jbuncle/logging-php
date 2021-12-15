<?php declare(strict_types=1);
/**
 * Copyright (C) 2019 James Buncle (https://www.jbuncle.co.uk) - All Rights Reserved
 */
namespace JBuncle\Logging\LoggerFactories;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * EmailLoggerFactoryTest.
 */
class EmailLoggerFactoryTest extends TestCase {

    public function testGetInstance(): void {
        $emailAddress = "some@mail.com";
        $emailLoggerFactory = new EmailLoggerFactory($emailAddress);
        $this->assertInstanceOf(LoggerInterface::class, $emailLoggerFactory->createLogger());
    }

}
