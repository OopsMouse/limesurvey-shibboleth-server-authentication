<?php

/**
 * This script ensures that the login form is modified to display a link to the Shibboleth login page.
 *
 * It needs to be called - using require_once - in
 *
 *      limesurvey/admin/admin.php
 *
 * after
 *
 *      include_once('login_check.php');
 *
 * around line 80.
 *
 * Extract:
 *
 * ...
 * ...
 *
 * if($casEnabled==true)
 * {
 *     include_once("login_check_cas.php");
 * }
 * else
 * {
 *     include_once('login_check.php');
 * }
 *
 * require_once(dirname(__FILE__) . '/auth/shibboleth/login_check.php'); <-- LINE TO BE ADDED
 *
 * ...
 * ...
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

require_once dirname(__FILE__) . '/test.php';
require_once dirname(__FILE__) . '/util.php';
require_once dirname(__FILE__) . '/shibboleth.class.php';
require_once dirname(__FILE__) . '/plugin.class.php';
require_once dirname(__FILE__) . '/user_home.class.php';
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/login.class.php';

$action = request('action');
$authentication = get('authentication');

if (isset($loginsummary) && !Login::is_logged_in()) {
    $loginsummary .= PluginShibboleth::get_login_link();
}
?>
