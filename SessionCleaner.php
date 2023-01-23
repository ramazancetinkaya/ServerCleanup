<?php

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

// You can use this class in your code like this:
$sessionCleaner = new SessionCleaner();
$sessionCleaner->clear();
