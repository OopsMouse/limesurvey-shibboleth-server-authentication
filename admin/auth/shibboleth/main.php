<?php

/*
 * Required includes by the plugin.
 * 
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */

$root = dirname(dirname(dirname(dirname(__FILE__))));

require_once dirname(__FILE__) . '/shibboleth.class.php';
require_once dirname(__FILE__) . '/lib/session.class.php';
require_once dirname(__FILE__) . '/aai.class.php';
require_once dirname(__FILE__) . '/lib/util.php';
require_once dirname(__FILE__) . '/lib/header.class.php';
require_once dirname(__FILE__) . '/plugin_shibboleth.class.php';
require_once dirname(__FILE__) . '/db/user_home.class.php';
require_once dirname(__FILE__) . '/lib/login.class.php';
require_once dirname(__FILE__) . '/config.php';

?>
