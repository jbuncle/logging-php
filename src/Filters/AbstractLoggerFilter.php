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

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

/**
 * AbstractLoggerFilter.
 *
 * phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
 * phpcs:disable JBuncle.CodeErrors.ConstructorCallsParent.Missing
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
abstract class AbstractLoggerFilter extends AbstractLogger {

    /**
     *
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
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
        if ($this->accept($level, $message, $context)) {
            $this->logger->log($level, $message, $context);
        }
    }

    /**
     *
     * @param string $level
     * @param string $message
     * @param array<mixed> $context
     *
     * @return bool
     */
    protected abstract function accept(string $level, string $message, array $context = array()): bool;

}
