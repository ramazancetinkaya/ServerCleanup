<?php

/**
 * SessionCleaner
 *
 * @author [ramazancetinkaya]
 * @date [23.01.2023]
 */

class SessionCleaner
{
    public function clear()
    {
        // Delete all cookies
        if (count($_COOKIE) > 0) {
            foreach ($_COOKIE as $cookie) {
                setcookie($cookie, '', time() - 3600);
            }
        }

        // Clear the session data
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }
}
