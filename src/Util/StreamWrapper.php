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

namespace JBuncle\Logging\Util;

use ErrorException;

/**
 * StreamWrapper
 *
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class StreamWrapper {

    /**
     *
     * @var resource|null
     */
    private $handle;

    /**
     *
     * @var string
     */
    private $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->handle = null;
    }

    public function write(string $string): ?int {
        if ($this->handle === null) {
            throw new \Exception("Stream not open");
        }

        $result = \fwrite($this->handle, $string);
        if ($result === false) {
            throw $this->getLastError();
        }

        return $result;
    }

    public function isOpen(): bool {
        return $this->handle !== null;
    }

    public function open(string $mode): void {
        if (isset($this->handle)) {
            $this->close();
        }

        $handle = @\fopen($this->filename, $mode);
        if ($handle === false) {
            throw $this->getLastError();
        }

        $this->handle = $handle;
    }

    private function getLastError(): ErrorException {
        $error = \error_get_last();

        $message = $error['message'];
        $type = $error['type'];
        $file = $error['file'];
        $line = $error['line'];

        if (empty($message)) {
            $message = "No error message defined";
        }

        if (empty($type)) {
            $type = 0;
        }

        if (empty($file)) {
            throw new ErrorException(
                    $message,
                    $type,
                    E_ERROR
            );
        }

        if (empty($line)) {
            throw new ErrorException(
                    $message,
                    $type,
                    E_ERROR,
                    $file
            );
        }

        throw new ErrorException(
                $message,
                $type,
                E_ERROR,
                $file,
                $line
        );
    }

    public function close(): void {
        if ($this->handle !== null) {
            \fclose($this->handle);
            $this->handle = null;
        }
    }

}
