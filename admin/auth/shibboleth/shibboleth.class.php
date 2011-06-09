<?php

/**
 * Interface to Shibboleth's attributes.
 * This class has no depencies outside of Shibboleth.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */
class Shibboleth {

    const UNIQUE_ID = 'unique_id';
    const FIRSTNAME = 'firstame';
    const LASTNAME = 'lastname';
    const EMAIL = 'email';
    const LANGUAGE = 'language';
    const GENDER = 'gender';
    const ADDRESS = 'address';
    const STAFF_CATEGORY = 'staff_category';
    const HOME_ORGANIZATION_TYPE = 'home_organization_type';
    const HOME_ORGANIZATION = 'home_organization';
    const AFFILIATION = 'affiliation';
    const LINK_TEXT = 'link_text';

    public static function get_link_text() {
        global $shibboleth_config;
        return $shibboleth_config[self::LINK_TEXT];
    }

    public static function get_unique_id() {
        return self::get(self::UNIQUE_ID);
    }

    public static function get_firstname() {
        return self::get(self::FIRSTNAME);
    }

    public static function get_lastname() {
        return self::get(self::LASTNAME);
    }

    public static function get_email() {
        return self::get(self::EMAIL);
    }

    public static function get_language() {
        return get(self::LANGUAGE);
    }

    public static function get_gender() {
        return self::get(self::GENDER);
    }

    public static function get_address() {
        return self::get(self::ADDRESS);
    }

    public static function get_staff_category() {
        return self::get(self::STAFF_CATEGORY);
    }

    public static function get_home_organization_type() {
        return self::get(self::HOME_ORGANIZATION_TYPE);
    }

    public static function get_home_organization() {
        return self::get(self::HOME_ORGANIZATION);
    }

    public static function get_affiliation() {
        return self::get(self::AFFILIATION);
    }

    /**
     * Returns the shibboleth value stored in $_SERVER if it exists or $default if it is not the case.
     *
     * @global array $shibboleth_config
     * @param string $name the generic name. I.e. one of the class const.
     * @param string $default default value if it is not provided by Shibboleth
     * @return string
     */
    public static function get($name='', $default = '') {
        global $shibboleth_config;
        if (empty($name)) {
            $result = array();
            foreach ($shibboleth_config as $key => $value) {
                if (isset($_SERVER[$value])) {
                    $result[$key] = $_SERVER[$value];
                }
            }
            return $result;
        }
        $shib_name = isset($shibboleth_config[$name]) ? $shibboleth_config[$name] : '';
        if ($shib_name) {
            return isset($_SERVER[$shib_name]) ? $_SERVER[$shib_name] : $default;
        } else {
            return $_SERVER;
        }
    }

}

?>