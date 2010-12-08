<?php

/**
 * Utility functions used by the Shibboleth package.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

/**
 * Returns the $_GET value for $name if it exists or $default if it is not the case.
 *
 * @param string $name
 * @param any $default
 * @return any
 */
function get($name='', $default = '') {
    if ($name) {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    } else {
        return $_GET;
    }
}

/**
 * Returns the $_REQUEST value for $name if it exists or $default if it is not the case.
 *
 * @param string $name
 * @param any $default
 * @return any
 */
function request($name='', $default = '') {
    if ($name) {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
    } else {
        return $_REQUEST;
    }
}

/**
 * Returns the $_SESSION value for $name if it exists or $default if it is not the case.
 *
 * @param string $name
 * @param any $default
 * @return any
 */
function session($name='', $default = '') {
    if ($name) {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
    } else {
        return $_SESSION;
    }
}

/**
 * Redirect to a url. If $url is not provider redirect to $rooturl.
 *
 * @global string $rooturl
 * @param string $url
 */
function redirect($url = '') {
    global $rooturl;
    $url = $url ? $url : $rooturl;
    header('Location: ' . $url);
}

?>
