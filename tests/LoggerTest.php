<?php declare(strict_types=1);
/**
 * Copyright (C) 2019 James Buncle (https://www.jbuncle.co.uk) - All Rights Reserved
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace JBuncle\Logging\Loggers;

use JBuncle\Logging\Logger;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use PHPUnit\Framework\TestCase;

/**
 * LoggerTest
 *
 * phpcs:disable JBuncle.CodeErrors.MemberInitialisation.Missing
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class LoggerTest extends TestCase {

    /**
     *
     * @var AbstractLogger
     */
    private $mockLogger;

    protected function setUp(): void {
        $this->mockLogger = $this->getMockForAbstractClass(AbstractLogger::class);
        Logger::setLogger($this->mockLogger);
    }

    public function testDebug(): void {
        $level = \Psr\Log\LogLevel::DEBUG;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::debug($message);
    }

    public function testError(): void {
        $level = LogLevel::ERROR;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::error($message);
    }

    public function testInformation(): void {
        $level = LogLevel::INFO;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::information($message);
    }

    public function testNotice(): void {
        $level = LogLevel::NOTICE;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::notice($message);
    }

    public function testWarning(): void {
        $level = LogLevel::WARNING;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::warning($message);
    }

    public function testLogger(): void {
        $level = LogLevel::WARNING;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        Logger::log($level, $message);
    }

    public function testGetLogger(): void {
        $level = LogLevel::WARNING;
        $message = "My test message";

        $this->mockLogger->expects($this->once())
            ->method('log')
            ->with($level, $message, []);

        $this->assertInstanceOf(\Psr\Log\LoggerInterface::class, Logger::getLogger());
        Logger::log($level, $message);
    }

}
