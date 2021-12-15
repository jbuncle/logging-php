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
 * EmailLoggerFormatter - Formats a message for email body.
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class EmailLoggerFormatter implements LoggerFormatter {

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
        $msg = 'Severity:  ' . strtoupper($level) . "\n";
        $msg .= 'Message:   ' . $message . "\n";

        if (\array_key_exists('exception', $context)) {
            $msg .= 'Exception:  ' . (string) $context['exception'] . "\n";
        }

        $msg .= 'Context:   ' . var_export($context, true) . "\n";
        $msg .= "\n\n";

        foreach ($this->getRequestHeaders() as $header => $value) {
            $msg .= "$header: $value";
            $msg .= "\n";
        }

        return $msg;
    }

    /**
     *
     * @return array<string,string>
     */
    private function getRequestHeaders(): array {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }

            $substr = substr($key, 5);
            if ($substr === false) {
                continue;
            }

            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower($substr))));
            $headers[$header] = $value;
        }

        return $headers;
    }

}
