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

use JBuncle\Logging\Formatters\StringLoggerFormatter;
use JBuncle\Logging\LoggerFactory;
use JBuncle\Logging\Loggers\ErrorLogLogger;
use Psr\Log\LoggerInterface;

/**
 * ErrorLogLoggerFactory
 *
 * @author jbuncle
 */
class ErrorLogLoggerFactory implements LoggerFactory {

    public function __construct() {
    }

    public function createLogger(): LoggerInterface {
        $formatter = StringLoggerFormatter::getInstance();

        return new ErrorLogLogger($formatter);
    }

}
