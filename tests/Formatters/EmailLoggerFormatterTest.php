<?php declare(strict_types=1);
/**
 * Copyright (C) 2019 James Buncle (https://www.jbuncle.co.uk) - All Rights Reserved
 */
namespace JBuncle\Logging\Formatters;

use JBuncle\Logging\LoggerFormatter;
use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * EmailLoggerFormatterTest
 */
class EmailLoggerFormatterTest extends TestCase {

    public function testGetInstance(): void {

        $this->assertInstanceOf(LoggerFormatter::class, EmailLoggerFormatter::getInstance());
    }

    public function testFormat(): void {

        $expected = "Severity:  ERROR\n"
                . "Message:   Something to log\n"
                . "Context:   array (\n"
                . ")\n"
                . "\n"
                . "\n";

        $formatter = EmailLoggerFormatter::getInstance();

        $formatted = $formatter->format(LogLevel::ERROR, "Something to log");
        $this->assertEquals($expected, $formatted);
    }

}
