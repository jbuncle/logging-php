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
use JBuncle\Logging\MailI;
use PHPUnit\Framework\TestCase;

/**
 * StreamLoggerTest
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class EmailLoggerTest extends TestCase {

    public function testLog(): void {
        $level = LogLevel::DEBUG;
        $message = "My test message";
        $context = [];
        $to = "some@testemailaddress.com";
        $subject = "DEBUG: " . $message;
        $formattedMessage = "The formatted message";

        $mockMail = $this->createMock(MailI::class);
        $mockLoggerFormatter = $this->createMock(LoggerFormatter::class);

        $mockMail->expects($this->once())
            ->method('mail')
            ->with($to, $subject, $formattedMessage);

        $mockLoggerFormatter->expects($this->once())
            ->method('format')
            ->with($level, $message, $context)
            ->will($this->returnValue($formattedMessage));

        $instance = new EmailLogger($mockMail, $to, $mockLoggerFormatter);
        $instance->log($level, $message, $context);
    }

}
