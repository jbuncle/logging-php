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
use Psr\Log\AbstractLogger;
use JBuncle\Logging\Util\StreamWrapper;

/**
 * StreamLogger
 *
 * phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
 * phpcs:disable SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
 * phpcs:disable JBuncle.CodeErrors.ConstructorCallsParent.Missing
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class StreamLogger extends AbstractLogger {

    /**
     *
     * @var StreamWrapper
     */
    private $stream;

    /**
     *
     * @var LoggerFormatter
     */
    private $formatter;

    public function __construct(
            StreamWrapper $stream,
            LoggerFormatter $formatter
    ) {
        $this->stream = $stream;
        $this->formatter = $formatter;
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
        $messageToLog = $this->format($level, $message, $context);
        $this->openStream($this->stream)
            ->write($messageToLog);
    }

    public function __destruct() {
        if (isset($this->stream)) {
            $this->stream->close();
        }
    }

    /**
     *
     * @param string $level
     * @param string $message
     * @param array<mixed> $context
     *
     * @return string
     */
    private function format(string $level, string $message, array $context = array()): string {
        return $this->formatter->format($level, $message, $context);
    }

    private function openStream(StreamWrapper $stream): StreamWrapper {
        if (!$stream->isOpen()) {
            $stream->open('a');
        }

        return $stream;
    }

}
