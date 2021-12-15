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

namespace JBuncle\Logging\Formatters;

use JBuncle\Logging\LoggerFormatter;

/**
 * StringLoggerFormatter - for converting log messages to a string.
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class StringLoggerFormatter implements LoggerFormatter {

    public function __construct() {
    }

    /**
     *
     * @var LoggerFormatter
     */
    private static $instance;

    /**
     * Get singleton instance of BasicFormatter.
     * Avoids creating multiple instances unnecessarily.
     *
     * @return LoggerFormatter
     */
    public static function getInstance(): LoggerFormatter {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     *
     * @param string $level
     * @param string $message
     * @param array<mixed> $context
     *
     * @return string
     */
    public function format(string $level, string $message, array $context = array()): string {
        if (!empty($context)) {
            return strtoupper($level) . " " . $message . " " . \var_export($context, true);
        } else {
            return strtoupper($level) . " " . $message;
        }
    }

}
