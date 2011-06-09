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

?>
