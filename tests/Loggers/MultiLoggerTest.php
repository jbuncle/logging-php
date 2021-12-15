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

use Psr\Log\LogLevel;
use Psr\Log\AbstractLogger;
use PHPUnit\Framework\TestCase;

/**
 * MultiLoggerTest
 *
 * phpcs:disable JBuncle.CodeErrors.MemberInitialisation.Missing
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class MultiLoggerTest extends TestCase {

    /**
     *
     * @var MultiLogger
     */
    private $instance;

    protected function setUp(): void {
        $this->instance = new MultiLogger();
    }

    public function testLog(): void {
        $level = LogLevel::DEBUG;
        $message = "My test message";
        $context = [];

        $mock1 = $this->getMockForAbstractClass(AbstractLogger::class);
        $mock1->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);
        $mock2 = $this->getMockForAbstractClass(AbstractLogger::class);
        $mock2->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);

        $instance = new MultiLogger();
        $instance->addLogger($mock1);
        $instance->addLogger($mock2);
        $instance->log($level, $message, $context);
    }

    public function testLogWithConstructor(): void {
        $level = LogLevel::DEBUG;
        $message = "My test message";
        $context = [];

        $mock1 = $this->getMockForAbstractClass(AbstractLogger::class);
        $mock1->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);
        $mock2 = $this->getMockForAbstractClass(AbstractLogger::class);
        $mock2->expects($this->once())
            ->method('log')
            ->with($level, $message, $context);

        $instance = new MultiLogger([$mock1, $mock2]);
        $instance->log($level, $message, $context);
    }

}
