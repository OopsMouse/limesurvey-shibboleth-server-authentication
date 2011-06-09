<?php

/**
 * Shibboleth authentication plugin class.
 * Contains the business logic for login a user into LimeSurvey with data provided by Shibboleth.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */
class PluginShibboleth
{
   
    const DISPLAY_WAYF = 'display_wayf';
    const NOTIFY = 'notify';

    /**
     * If true and there is a WAYF block it is displayed instead of the link. If false the link is displayed.
     */
    public static function get_display_wayf()
    {
        global $shibboleth_config;
        return isset($shibboleth_config[self::DISPLAY_WAYF]) ? $shibboleth_config[self::DISPLAY_WAYF] : false;
    }
    
    /**
     * If true send notifications - emails - for events - new users - to the site admin. 
     */
    public static function get_notify(){
        global $shibboleth_config;
        return isset($shibboleth_config[self::NOTIFY]) ? $shibboleth_config[self::NOTIFY] : false;
    }

    /**
     * Returns the html snippet that is included after the login page.
     * That is output of login_link.php.
     *
     * @return string
     */
    public static function get_login_link()
    {
        ob_start();
        require dirname(__FILE__) . '/login_link.php';
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    /**
     * Returns the user name used by limesurvey.
     * If there is an email use it. Othewise defaults to unige_id.
     *
     * @return string
     */
    public static function get_user_name()
    {
        $result = Shibboleth::get_email();
        $result = $result ? $result : Shibboleth::get_unique_id();
        return $result;
    }

    /**
     * Returns the user inteface language used by LimeSurvey based on Shibboleth's attribute.
     * If the language is not installed defaults to english.
     *
     * @return string
     */
    public static function get_language()
    {
        $lang = shibboleth::get_language();
        $lang = strtolower(substr(trim($lang), 0, 2));
        $languages = self::get_available_languages();
        $lang = isset($languages[$lang]) ? $lang : 'en';
        return $lang;
    }

    /**
     * Returns the list of installed languages available for the user interface.
     *
     * @return <type>
     */
    public static function get_available_languages()
    {
        $result = array();
        $dir = dirname(__FILE__) . '/../../../locale/';
        $files = scandir($dir);
        $files = array_diff($files, array('.', '..'));
        foreach ($files as $file)
        {
            if (is_dir($dir . $file))
            {
                $lang_key = strtolower(substr($file, 0, 2));
                $result[$lang_key] = $lang_key; //we limit the choice to the base choice. I.e. fr and not fr-ch.
            }
        }
        return $result;
    }

    /**
     * Returns the Shibboleth's user. That is an array made of data provided by Shibboleth.
     *
     * @return array
     */
    public static function get_shibboleth_user()
    {
        global $shibboleth_default_user;
        $result = $shibboleth_default_user; //array copy
        $result[UserHome::USERS_NAME] = self::get_user_name();
        $result[UserHome::PASSWORD] = createPassword();
        $result[UserHome::FULL_NAME] = Shibboleth::get_firstname() . ' ' . Shibboleth::get_lastname();
        $result[UserHome::PARENT_ID] = UserHome::get_initial_admin_uid();
        $result[UserHome::LANG] = self::get_language();
        $result[UserHome::EMAIL] = Shibboleth::get_email();
        $result[UserHome::ONE_TIME_PW] = createPassword();
        return $result;
    }

    /**
     * Login the current Shibboleth user. Autocreate it if he does't exist.
     */
    public static function login()
    {
        $user_name = self::get_user_name();
        $user_exist = UserHome::exists($user_name);
        if (!$user_exist)
        {
            $user = self::get_shibboleth_user();
            UserHome::create($user);
            self::on_new_user($user);
        }
        Login::login_user($user_name);
    }

    /**
     * Logout the current user.
     */
    public static function logout()
    {
        Login::logout_user();
    }

    public static function on_new_user($user)
    {
        if (!self::get_notify())
        {
            return false;
        }

        global $siteadminname, $siteadminemail;

        ob_start();
        require dirname(__FILE__) . '/resources/new_user.tpl.php';
        $body = ob_get_contents();
        ob_end_clean();

        $subject = 'New user';
        SendEmailMessage($body, $subject, $to = $siteadminemail, $from = $siteadminemail, $sitename = $siteadminname, $ishtml = true);
    }

}

?>