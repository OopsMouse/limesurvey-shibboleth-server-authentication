<?php

/**
 * This script ensures that the login form is modified to display a link to the Shibboleth login page.
 *
 * It needs to be called - using require_once - in
 *
 *      limesurvey/admin/admin.php
 *
 * See patch/patch.class.php for further details.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

require_once dirname(__FILE__) . '/main.php';

$action = request('action');
$authentication = get('authentication');

if (isset($loginsummary) && !Login::is_logged_in()) {
    $loginsummary .= PluginShibboleth::get_login_link();
}
?>
