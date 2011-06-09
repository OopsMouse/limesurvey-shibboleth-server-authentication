<?php

/**
 * The Switch AAI Shibboleth configuration. 
 * 
 * @see http://www.switch.ch/aai/index.html
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class AAI
{
    const UNIQUE_ID = 'Shib-SwissEP-UniqueID';
    const FIRSTNAME = 'Shib-InetOrgPerson-givenName';
    const LASTNAME = 'Shib-Person-surname';
    const EMAIL = 'Shib-InetOrgPerson-mail';
    const LANGUAGE = 'Shib-InetOrgPerson-preferredLanguage';
    const GENDER = 'Shib-SwissEP-Gender';
    const ADDRESS = 'Shib-OrgPerson-postalAddress';
    const STAFF_CATEGORY = 'Shib-SwissEP-StaffCategory';
    const HOME_ORGANIZATION_TYPE = 'Shib-SwissEP-HomeOrganizationType';
    const HOME_ORGANIZATION = 'Shib-SwissEP-HomeOrganization';
    const AFFILIATION = 'Shib-EP-Affiliation';

    /**
     * if true and there is a WAYF block it is displayed instead of the link. If false the link is displayed.
     */
    const PluginDISPLAY_WAYF = false;

    public static function get_configuration()
    {
        $result = array();
        $result[Shibboleth::UNIQUE_ID] = self::UNIQUE_ID;
        $result[Shibboleth::FIRSTNAME] = self::FIRSTNAME;
        $result[Shibboleth::LASTNAME] = self::LASTNAME;
        $result[Shibboleth::EMAIL] = self::EMAIL;
        $result[Shibboleth::LANGUAGE] = self::LANGUAGE;
        $result[Shibboleth::GENDER] = self::GENDER;
        $result[Shibboleth::ADDRESS] = self::ADDRESS;
        $result[Shibboleth::STAFF_CATEGORY] = self::STAFF_CATEGORY;
        $result[Shibboleth::HOME_ORGANIZATION_TYPE] = self::HOME_ORGANIZATION_TYPE;
        $result[Shibboleth::HOME_ORGANIZATION] = self::HOME_ORGANIZATION;
        $result[Shibboleth::AFFILIATION] = self::AFFILIATION;

        /**
         * Text of the link displayed after the login form
         */
        $result[Shibboleth::LINK_TEXT] = 'SWITCH AAI Login';
        $result[PluginShibboleth::DISPLAY_WAYF] = false;
        
        $result[PluginShibboleth::NOTIFY] = true;
        return $result;
    }

    /**
     * Default values. Used upon first login when the user is created in the database.
     */
    public static function get_default_user()
    {
        global $defaulthtmleditormode;

        $result = array();
        $result[UserHome::USERS_NAME] = '';
        $result[UserHome::PASSWORD] = '';
        $result[UserHome::FULL_NAME] = '';
        $result[UserHome::PARENT_ID] = '';
        $result[UserHome::LANG] = '';
        $result[UserHome::EMAIL] = '';
        $result[UserHome::ONE_TIME_PW] = '';
        $result[UserHome::CREATE_SURVEY] = false;
        $result[UserHome::CREATE_USER] = false;
        $result[UserHome::DELETE_USER] = false;
        $result[UserHome::SUPERADMIN] = false;
        $result[UserHome::CONFIGURATOR] = false;
        $result[UserHome::MANAGE_TEMPLATE] = false;
        $result[UserHome::MANAGE_LABEL] = false;
        $result[UserHome::HTML_EDITOR_MODE] = $defaulthtmleditormode;
        $result[UserHome::DATE_FORMAT] = true;
        return $result;
    }

}

?>
