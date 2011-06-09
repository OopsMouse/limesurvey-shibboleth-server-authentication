<?php

/**
 * Logic to manage the application's current user.
 * I.e. to login an logout a user.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 */
class Login {

    const USER = 'user';
    const LOGIN_ID = 'loginID';
    const DATEFORMAT = 'dateformat';
    const ADMIN_LANG = 'adminlang';
    const HTML_EDITOR_MODE = 'htmleditormode';
    const CHECK_SESSION_POST = 'checksessionpost';
    const PW_NOTIFY = 'pw_notify';
    const USER_RIGHT_CREATE_SURVEY = 'USER_RIGHT_CREATE_SURVEY';
    const USER_RIGHT_CONFIGURATOR= 'USER_RIGHT_CONFIGURATOR';
    const USER_RIGHT_CREATE_USER= 'USER_RIGHT_CREATE_USER';
    const USER_RIGHT_DELETE_USER= 'USER_RIGHT_DELETE_USER';
    const USER_RIGHT_SUPERADMIN= 'USER_RIGHT_SUPERADMIN';
    const USER_RIGHT_MANAGE_TEMPLATE= 'USER_RIGHT_MANAGE_TEMPLATE';
    const USER_RIGHT_MANAGE_LABEL= 'USER_RIGHT_MANAGE_LABEL';

    public static function is_logged_in(){
        return (bool)Session::get(self::USER);
    }

    /**
     * Makes $user the current - loged-in - user.
     * If $user is a string fetch it's profile from the database.
     */
    public static function login_user($user) {
        if(empty($user)){
            return false;
        }
        $user = is_string($user) ? UserHome::get($user) : $user;

        self::init_session($user);
    }

    /**
     * Logout the current user.
     */
    public static function logout_user() {
        Session::clear();
    }

    /**
     * Populate the current session with $user's data.
     *
     * @param array $user
     */
    public static function init_session($user) {
        $_SESSION[self::USER] = $user[UserHome::USERS_NAME];
        $_SESSION[self::LOGIN_ID] = $user[UserHome::UID];
        $_SESSION[self::DATEFORMAT] = $user[UserHome::DATE_FORMAT];
        $_SESSION[self::ADMIN_LANG] = $user[UserHome::LANG]; //$defaultlang;
        $_SESSION[self::HTML_EDITOR_MODE] = $user[UserHome::HTML_EDITOR_MODE];

        $_SESSION[self::CHECK_SESSION_POST] = rand(0, 1000000);
        $_SESSION[self::PW_NOTIFY] = false;

        $_SESSION[self::USER_RIGHT_CREATE_SURVEY] = $user[UserHome::CREATE_SURVEY];
        $_SESSION[self::USER_RIGHT_CONFIGURATOR] = $user[UserHome::CONFIGURATOR];
        $_SESSION[self::USER_RIGHT_CREATE_USER] = $user[UserHome::CREATE_USER];
        $_SESSION[self::USER_RIGHT_DELETE_USER] = $user[UserHome::DELETE_USER];
        $_SESSION[self::USER_RIGHT_SUPERADMIN] = $user[UserHome::SUPERADMIN];
        $_SESSION[self::USER_RIGHT_MANAGE_TEMPLATE] = $user[UserHome::MANAGE_TEMPLATE];
        $_SESSION[self::USER_RIGHT_MANAGE_LABEL] = $user[UserHome::MANAGE_LABEL];
    }
}

?>
