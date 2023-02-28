<?php

/**
 * Class ServerCleanup
 *
 * A class that provides methods for clearing all sessions and cookies on a server.
 */
class ServerCleanup
{
    /**
     * Clears all sessions on the server.
     *
     * @return void
     */
    public static function clearSessions(): void
    {
        // Start a new or resume an existing session.
        session_start();
        
        // Unset all session variables.
        $_SESSION = array();
        
        // If the session was propagated using a cookie, remove that cookie.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Finally, destroy the session.
        session_destroy();
    }
    
    /**
     * Clears all cookies on the server, unless a list of specific cookies is provided.
     *
     * @param array $cookiesToKeep An optional array of cookie names to keep.
     *
     * @return void
     */
    public static function clearCookies(array $cookiesToKeep = []): void
    {
        // Get all cookies currently set on the server.
        $cookies = $_COOKIE;
        
        // If specific cookies are provided to keep, remove them from the array of cookies to delete.
        if (!empty($cookiesToKeep)) {
            foreach ($cookiesToKeep as $cookie) {
                unset($cookies[$cookie]);
            }
        }
        
        // Delete all cookies on the server.
        foreach ($cookies as $name => $value) {
            setcookie($name, '', time() - 3600);
        }
    }
    
    /**
     * Clears all sessions and cookies on the server.
     *
     * @param array $cookiesToKeep An optional array of cookie names to keep.
     *
     * @return void
     */
    public static function clearAll(array $cookiesToKeep = []): void
    {
        self::clearSessions();
        self::clearCookies($cookiesToKeep);
    }
}
