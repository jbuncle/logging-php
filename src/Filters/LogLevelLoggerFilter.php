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

namespace JBuncle\Logging\Filters;

use InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * LogLevelLoggerFilter
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class LogLevelLoggerFilter extends AbstractLoggerFilter implements \Psr\Log\LoggerInterface {

    /**
     *
     * @var array<string, int>
     */
    private static $LEVELS = [
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT => 1,
        LogLevel::CRITICAL => 2,
        LogLevel::ERROR => 3,
        LogLevel::WARNING => 4,
        LogLevel::NOTICE => 5,
        LogLevel::INFO => 6,
        LogLevel::DEBUG => 7,
    ];

    const MORE_SEVERE = 1;
    const SAME_SEVERE = 0;
    const LESS_SEVERE = -1;

    /**
     *
     * @var int
     */
    private $level;

    /**
     * Whether we are allowing levels below the log level specified (or above).
     *
     * Use LogLevelLoggerFilter::ABOVE or LogLevelLoggerFilter::BELOW.
     *
     * Inclusive.
     *
     * @var int
     */
    private $severityDifference;

    public function __construct(
            \Psr\Log\LoggerInterface $logger,
            string $level,
            int $severityDifference
    ) {
        parent::__construct($logger);

        if (!in_array($severityDifference, [self::LESS_SEVERE, self::SAME_SEVERE, self::MORE_SEVERE])) {
            throw new InvalidArgumentException("Severity difference '$severityDifference' is not an expected value");
        }

        $this->level = self::levelToInt($level);
        $this->severityDifference = $severityDifference;
    }

    /**
     *
     * @param string $level
     * @param string $message
     * @param array<mixed> $context
     *
     * @return bool
     */
    protected function accept(string $level, string $message, array $context = array()): bool {
        $levelInt = self::levelToInt($level);
        if ($this->severityDifference === self::LESS_SEVERE) {
            return $levelInt >= $this->level;
        }

        if ($this->severityDifference === self::MORE_SEVERE) {
            // More severe has lower numeric value
            return $levelInt <= $this->level;
        }

        if ($this->severityDifference === self::SAME_SEVERE) {
            return $levelInt === $this->level;
        }

        return false;
    }

    private static function levelToInt(string $level): int {
        return self::$LEVELS[$level];
    }

}
