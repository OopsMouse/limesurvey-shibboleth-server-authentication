<?php

/**
 * Session management.
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class Session
{

    /**
     * Returns the $_SESSION value for $name if it exists or $default if it is not the case.
     *
     * @param string $name
     * @param any $default
     * @return any
     */
    public static function get($name='', $default = '')
    {
        if ($name)
        {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
        }
        else
        {
            return $_SESSION;
        }
    }

    /**
     * Clear the session.
     */
    public static function clear()
    {
        if (session_id())
        {
            session_destroy();
            session_write_close();
        }
    }

}

?>
