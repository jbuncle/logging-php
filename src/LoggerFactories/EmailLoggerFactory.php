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

namespace JBuncle\Logging\LoggerFactories;

use JBuncle\Logging\Filters\LogLevelLoggerFilter;
use JBuncle\Logging\Formatters\EmailLoggerFormatter;
use JBuncle\Logging\LoggerFactory;
use JBuncle\Logging\Loggers\EmailLogger;
use JBuncle\Logging\Util\SendMail;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * EmailLoggerFactory
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class EmailLoggerFactory implements LoggerFactory {

    /**
     *
     * @var string
     */
    private $emailAddress;

    public function __construct(string $emailAddress) {
        $this->emailAddress = $emailAddress;
    }

    public function createLogger(): LoggerInterface {
        $formatter = EmailLoggerFormatter::getInstance();
        $mail = new SendMail();
        return new LogLevelLoggerFilter(
                new EmailLogger($mail, $this->emailAddress, $formatter),
                LogLevel::ERROR,
                LogLevelLoggerFilter::MORE_SEVERE
        );
    }

}
