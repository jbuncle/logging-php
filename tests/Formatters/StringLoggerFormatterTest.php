<?php declare(strict_types=1);
namespace JBuncle\Logging\Formatters;

use JBuncle\Logging\LoggerFormatter;
use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;

class StringLoggerFormatterTest extends TestCase {

    public function testGetInstance(): void {

        $this->assertInstanceOf(LoggerFormatter::class, StringLoggerFormatter::getInstance());
    }

    public function testFormat(): void {

        $expected = "ERROR Something to log";

        $formatter = StringLoggerFormatter::getInstance();

        $formatted = $formatter->format(LogLevel::ERROR, "Something to log");
        $this->assertEquals($expected, $formatted);
    }

}
