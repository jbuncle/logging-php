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

use JBuncle\Logging\LoggerFormatter;
use Psr\Log\LogLevel;
use JBuncle\Logging\Util\StreamWrapper;
use PHPUnit\Framework\TestCase;

/**
 * StreamLoggerTest
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class StreamLoggerTest extends TestCase {

    public function testLog(): void {
        $level = LogLevel::DEBUG;
        $message = "My test message";
        $context = [];

        $formattedMessage = "The formatted message";

        $mockStreamWrapper = $this->createMock(StreamWrapper::class);
        $mockLoggerFormatter = $this->createMock(LoggerFormatter::class);

        $mockStreamWrapper->expects($this->once())
            ->method('open')
            ->with('a');
        $mockStreamWrapper->expects($this->once())
            ->method('isOpen')
            ->will($this->returnValue(false));
        $mockStreamWrapper->expects($this->once())
            ->method('write')
            ->with($formattedMessage);
        $mockStreamWrapper->expects($this->once())
            ->method('close');

        $mockLoggerFormatter->expects($this->once())
            ->method('format')
            ->with($level, $message, $context)
            ->will($this->returnValue($formattedMessage));

        $instance = new StreamLogger($mockStreamWrapper, $mockLoggerFormatter);
        $instance->log($level, $message, $context);
    }

}
