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

use JBuncle\Logging\MailI;

/**
 * Mail
 *
 * @author James Buncle <jbuncle@hotmail.com>
 */
class SendMail implements MailI {

    public function __construct() {
    }

    /**
     * Send mail.
     *
     * @codeCoverageIgnore Has side effects.
     *
     * @param string $to
     * @param string $subject
     * @param string $message
     *
     * @return bool
     */
    public function mail(
            string $to,
            string $subject,
            string $message
    ): bool {
        return \mail($to, $subject, $message);
    }

}
