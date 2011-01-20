<?php

/**
 * Shibboleth configuration file.
 * Modify this file to fit your needs.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */

/**
 *
 * Shibboleth fields' mapping.
 * This needs to be configured to reflect your shibboleth's configuration.
 */
$shibboleth_config = array();
$shibboleth_config[shibboleth::UNIQUE_ID] = 'Shib-SwissEP-UniqueID';
$shibboleth_config[shibboleth::FIRSTNAME] = 'Shib-InetOrgPerson-givenName';
$shibboleth_config[shibboleth::LASTNAME] = 'Shib-Person-surname';
$shibboleth_config[shibboleth::EMAIL] = 'Shib-InetOrgPerson-mail';
$shibboleth_config[shibboleth::LANGUAGE] = 'Shib-InetOrgPerson-preferredLanguage';
$shibboleth_config[shibboleth::GENDER] = 'Shib-SwissEP-Gender';
$shibboleth_config[shibboleth::ADDRESS] = 'Shib-OrgPerson-postalAddress';
$shibboleth_config[shibboleth::STAFF_CATEGORY] = 'Shib-SwissEP-StaffCategory';
$shibboleth_config[shibboleth::HOME_ORGANIZATION_TYPE] = 'Shib-SwissEP-HomeOrganizationType';
$shibboleth_config[shibboleth::HOME_ORGANIZATION] = 'Shib-SwissEP-HomeOrganization';
$shibboleth_config[shibboleth::AFFILIATION] = 'Shib-EP-Affiliation';

/**
 * Text of the link displayed after the login form
 */
$shibboleth_config[shibboleth::LINK_TEXT] = 'SWITCH AAI Login';

/**
 * if true and there is a WAYF block it is displayed instead of the link. If false the link is displayed.
 */
$shibboleth_config[PluginShibboleth::DISPLAY_WAYF] = false;


/**
 * Default values. Used upon first login when the user is created in the database.
 */
$shibboleth_default = array();
$shibboleth_default[UserHome::CREATE_SURVEY] = false;
$shibboleth_default[UserHome::CREATE_USER] = false;
$shibboleth_default[UserHome::DELETE_USER] = false;
$shibboleth_default[UserHome::SUPERADMIN] = false;
$shibboleth_default[UserHome::CONFIGURATOR] = false;
$shibboleth_default[UserHome::MANAGE_TEMPLATE] = false;
$shibboleth_default[UserHome::MANAGE_LABEL] = false;
$shibboleth_default[UserHome::HTML_EDITOR_MODE] = $defaulthtmleditormode;
$shibboleth_default[UserHome::DATE_FORMAT] = true;
?>
