<?php declare(strict_types=1);
/**
 * Copyright (C) 2019 James Buncle (https://www.jbuncle.co.uk) - All Rights Reserved
 */

namespace JBuncle\Logging\Filters;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * LogLevelLoggerFilterTest
 *
 * phpcs:disable JBuncle.CodeErrors.MemberInitialisation.Missing
 */
class LogLevelLoggerFilterTest extends TestCase {

    /**
     * @var LogLevelLoggerFilter
     */
    private $instance;

    /**
     *
     * @var AbstractLogger|MockObject
     */
    private $mockLogger;

    /**
     * Sets up the fixture.
     */
    protected function setUp(): void {
        $this->mockLogger = $this->getMockForAbstractClass(AbstractLogger::class);
        $this->instance = new LogLevelLoggerFilter(
                $this->mockLogger, // @phan-suppress-current-line PhanTypeMismatchArgument
                LogLevel::WARNING,
                LogLevelLoggerFilter::MORE_SEVERE
        );
    }

    public function testLogsMoreSevere(): void {
        $level = LogLevel::ERROR;
        $message = "My test message";
        $context = [];

        $this->mockLogger // @phan-suppress-current-line PhanAccessMethodInternal, PhanPossiblyUndeclaredMethod
            ->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);

        $this->instance->log($level, $message, $context);
    }

    public function testLogsSameSevere(): void {
        $level = LogLevel::WARNING;
        $message = "My test message";
        $context = [];

        $this->mockLogger // @phan-suppress-current-line PhanAccessMethodInternal
            ->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);
        $instance = new LogLevelLoggerFilter(
                $this->mockLogger,
                LogLevel::WARNING,
                LogLevelLoggerFilter::SAME_SEVERE
        );

        $instance->log($level, $message, $context);
    }

    public function testDoesntLogLessSevere(): void {
        $level = LogLevel::DEBUG;
        $message = "My test message";
        $context = [];

        $this->mockLogger // @phan-suppress-current-line PhanAccessMethodInternal
            ->expects($this->never())
            ->method('log')
            ->with($level, $message, $context);

        $this->instance->log($level, $message, $context);
    }

}
