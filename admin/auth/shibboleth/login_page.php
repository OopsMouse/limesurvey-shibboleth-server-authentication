<?php

/**
 * Shibboleth login page.
 * This page should be secured by the web server shibboleth's security module.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

$root = dirname(dirname(dirname(dirname(__FILE__))));

require_once $root . '/classes/core/startup.php';
require_once $root . '/config-defaults.php';
require_once $root . '/common.php';
require_once $root . '/admin/classes/core/sha256.php';
require_once $root . '/admin/sessioncontrol.php'; //needed to create the session

require_once dirname(__FILE__) . '/test.php';
require_once dirname(__FILE__) . '/util.php';
require_once dirname(__FILE__) . '/shibboleth.class.php';
require_once dirname(__FILE__) . '/plugin.class.php';
require_once dirname(__FILE__) . '/user_home.class.php';
require_once dirname(__FILE__) . '/login.class.php';
require_once dirname(__FILE__) . '/config.php';

if (request('action') == 'login' || empty($user)) {
    PluginShibboleth::login();
}

redirect($rooturl . '/admin/admin.php');

?>