<?php declare(strict_types=1);
/**
 * Copyright (C) 2021 jbuncle
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
 * DefaultContextWrapper
 *
 * @author jbuncle
 */
class DefaultContextWrapper extends AbstractLogger implements LoggerInterface {

    private LoggerInterface $logger;
    private array $defaultContext;

    public function __construct(LoggerInterface $logger, array $context) {
        $this->defaultContext = $context;
        $this->logger = $logger;
    }

    public function log($level, $message, mixed $context = []): void {
        // Combine contexts
        $fullContext = array_merge($this->defaultContext, $context);
        // Log
        $this->logger->log($level, $message, $fullContext);
    }

}
