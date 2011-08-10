<?php

/**
 * Shibboleth login page.
 * This page should be secured by the web server shibboleth's security module.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

/*
 * @todo: remove that:
 */

//require_once dirname(__FILE__) . '/test/new_user.php';

$root = dirname(dirname(dirname(dirname(__FILE__))));

require_once $root . '/classes/core/startup.php';
require_once $root . '/config-defaults.php';
require_once $root . '/common.php';
require_once $root . '/admin/classes/core/sha256.php';
require_once $root . '/admin/sessioncontrol.php'; //needed to create the session

require_once dirname(__FILE__) . '/main.php';

if (request('action') == 'login' || empty($user)) {
    PluginShibboleth::login();
}

Header::Redirect($rooturl . '/admin/admin.php');

?>