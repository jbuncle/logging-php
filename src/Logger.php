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

namespace JBuncle\Logging;

use JBuncle\Logging\LoggerManager\LoggerManager;
use JBuncle\Logging\Loggers\DefaultContextWrapper;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Logger - Convenience class for logging.
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class Logger {

    private function __construct() {

    }

    /**
     *
     * @var LoggerManager
     */
    private static $logger;

    private static function getInstance(): LoggerInterface {
        if (!isset(self::$logger)) {
            self::$logger = new NullLogger();
        }

        return self::$logger;
    }

    public static function setLogger(LoggerInterface $logger): void {
        self::$logger = $logger;
    }

    public static function getLogger(array $defaultContext = []): LoggerInterface {
        $logger = self::getInstance();
        if (empty($defaultContext)) {
            return $logger;
        }

        return new DefaultContextWrapper($logger, $defaultContext);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function debug(string $message, array $context = []): void {
        self::getInstance()->debug($message, $context);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function error(string $message, array $context = []): void {
        self::getInstance()->error($message, $context);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function information(string $message, array $context = []): void {
        self::getInstance()->info($message, $context);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function notice(string $message, array $context = []): void {
        self::getInstance()->notice($message, $context);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function warning(string $message, array $context = []): void {
        self::getInstance()->warning($message, $context);
    }

    /**
     *
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public static function log(string $level, string $message, array $context = []): void {
        self::getInstance()->log($level, $message, $context);
    }

}
