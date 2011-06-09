<?php

/**
 * This file's output appears after the login form.
 *
 * It adds a link that point to login_page.php using the text defined in config.php.
 * If required this file can be further modified to your fit your needs.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */
$root = dirname(dirname(dirname(dirname(__FILE__))));

require_once $root . '/classes/core/startup.php';
require_once $root . '/config-defaults.php';
require_once $root . '/common.php';

$result = '';
if (PluginShibboleth::get_display_wayf()) {
    $file = dirname(__FILE__) . '/resources/wayf.xhtml';
    if (file_exists($file)) {
        $result = '<div style="width:300px;margin-left:auto;margin-right:auto;">' . file_get_contents($file) . '</div>';
    }
}

if (empty($result)) {
    global $rooturl;
    $href = $rooturl . '/admin/auth/shibboleth/login_page.php';
    $text = Shibboleth::get_link_text();
    $img = $rooturl . '/admin/auth/shibboleth/resources/buttonflat.gif';

    $result = '<p width="100%;text-align=center;"><a  href="' . $href . '"><img src="' . $img . '" alt="' . $text . '" /></a></p><br />';
}

echo $result;

?>
