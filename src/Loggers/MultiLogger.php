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

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * MultiLogger
 *
 * phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
 * phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
 * phpcs:disable JBuncle.CodeErrors.ConstructorCallsParent.Missing
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class MultiLogger extends AbstractLogger {

    /**
     *
     * @var array<LoggerInterface>
     */
    private $loggers;

    /**
     *
     * @param array<LoggerInterface> $loggers
     */
    public function __construct(array $loggers = []) {
        $this->loggers = [];
        foreach ($loggers as $logger) {
            $this->addLogger($logger);
        }
    }

    public function addLogger(LoggerInterface $logger): self {
        $this->loggers[] = $logger;

        return $this;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array<mixed> $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array()): void {
        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }

}
