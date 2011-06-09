<?php

/**
 * Class for managing the database user table.
 *
 * @copyright 2010, University of Geneva
 * @author laurent.opprecht@unige.ch
 * @license GNU, http://www.gnu.org/licenses/gpl.html
 *
 */
class UserHome {

    const PRIMARY_KEY = 'uid';

    const UID = 'uid';
    const USERS_NAME = 'users_name';
    const PASSWORD = 'password';
    const ONE_TIME_PW = 'one_time_pw';
    const FULL_NAME = 'full_name';
    const PARENT_ID = 'parent_id';
    const LANG = 'lang';
    const EMAIL = 'email';
    const CREATE_SURVEY = 'create_survey';
    const CREATE_USER = 'create_user';
    const DELETE_USER = 'delete_user';
    const SUPERADMIN = 'superadmin';
    const CONFIGURATOR = 'configurator';
    const MANAGE_TEMPLATE = 'manage_template';
    const MANAGE_LABEL = 'manage_label';
    const HTML_EDITOR_MODE = 'htmleditormode';
    const DATE_FORMAT = 'dateformat';
    
    /**
     * Returns the table's name used to store users
     *
     * @return string
     */
    public static function get_table_name() {
        return db_table_name('users');
    }

    public static function get_initial_admin_uid() {
        global $dbprefix;
        // Initial SuperAdmin has parent_id == 0
        $query = "SELECT uid FROM {$dbprefix}users WHERE parent_id=0";
        $result = db_select_limit_assoc($query, 1);
        $row = $result->FetchRow();
        return $row['uid'];
    }

    /**
     * Retrieve from database the user's row for $user_name.
     *
     * @global object $connect
     * @global string $ADODB_FETCH_MODE
     * @param string $user_name
     * @return array|boolean
     */
    public static function get($user_name) {
        global $connect;
        global $ADODB_FETCH_MODE;

        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        $query = 'SELECT * FROM ' . self::get_table_name() . ' WHERE users_name=' . self::quote($user_name);
        $result = $connect->SelectLimit($query, 1);

        if ($result->RecordCount() == 1) {
            return $result->FetchRow();
        } else {
            return false;
        }
    }

    /**
     * Returns true if a row exists for $user_name. False otherwise.
     *
     * @global object $connect
     * @global string $ADODB_FETCH_MODE
     * @param string $user_name
     * @return bool
     */
    public static function exists($user_name) {
        global $connect;
        global $ADODB_FETCH_MODE;

        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        $query = 'SELECT * FROM ' . self::get_table_name() . ' WHERE users_name=' . self::quote($user_name);
        $result = $connect->SelectLimit($query, 1);


        return $result->RecordCount() == 1;
    }

    /**
     * Create a new user row in the database.
     *
     * @param string $user_name
     * @param string $full_name
     * @param string $email
     * @param string $password
     * @param string $one_time_password
     * @param string $lang
     * @param string $parent_id
     * @param string $create_survey
     * @param string $create_user
     * @param string $delete_user
     * @param string $superadmin
     * @param string $configurator
     * @param string $manage_template
     * @param string $manage_label
     * @param string $html_editor_mode
     * @param string $date_format
     * @return int|bool the id of the newly crated record or false in case of failure
     */
    public static function create_row($user_name, $full_name, $email = '', $password = '', $one_time_password = '', $lang = 'en', $parent_id = false, $create_survey = false, $create_user = false, $delete_user = false, $superadmin = false, $configurator = false, $manage_template = false, $manage_label = false, $html_editor_mode = 'default', $date_format = true) {
        global $connect;
        
        $values = array();
        $values[self::USERS_NAME] = self::quote($user_name);
        $values[self::PASSWORD] = self::quote(SHA256::hashing($password));
        $values[self::ONE_TIME_PW] = self::quote(SHA256::hashing($one_time_password));
        $values[self::FULL_NAME] = self::quote($full_name);
        $values[self::PARENT_ID] = $parent_id ? $parent_id : getInitialAdmin_uid();
        $values[self::LANG] = self::quote($lang);
        $values[self::EMAIL] = self::quote($email);
        $values[self::CREATE_SURVEY] = intval($create_survey);
        $values[self::CREATE_USER] = intval($create_user);
        $values[self::DELETE_USER] = intval($delete_user);
        $values[self::SUPERADMIN] = intval($superadmin);
        $values[self::CONFIGURATOR] = intval($configurator);
        $values[self::MANAGE_TEMPLATE] = intval($manage_template);
        $values[self::MANAGE_LABEL] = intval($manage_label);
        $values[self::HTML_EDITOR_MODE] = self::quote($html_editor_mode);
        $values[self::DATE_FORMAT] = intval($date_format);

        $key = array_keys($values);
        $values = array_values($values);

        $query = 'INSERT INTO ' . self::get_table_name()
                . '(' . implode(',', $key) . ') '
                . 'VALUES (' . implode(',', $values) . ')';

        return self::insert($query);
    }

    /**
     * Create a new user row in the database.
     *
     * @param array $user
     * @return int|bool the id of the newly crated record or false in case of failure
     */
    public static function create($user) {
        $user_name = $user[self::USERS_NAME];
        $password = $user[self::PASSWORD];
        $one_time_password = $user[self::ONE_TIME_PW];
        $full_name = $user[self::FULL_NAME];
        $parent_id = $user[self::PARENT_ID];
        $lang = $user[self::LANG];
        $email = $user[self::EMAIL];
        $create_survey = $user[self::CREATE_SURVEY];
        $create_user = $user[self::CREATE_USER];
        $delete_user = $user[self::DELETE_USER];
        $superadmin = $user[self::SUPERADMIN];
        $configurator = $user[self::CONFIGURATOR];
        $manage_template = $user[self::MANAGE_TEMPLATE];
        $manage_label = $user[self::MANAGE_LABEL];
        $html_editor_mode = $user[self::HTML_EDITOR_MODE];
        $date_format = $user[self::DATE_FORMAT];

        return self::create_row($user_name, $full_name, $email, $password, $one_time_password, $lang, $parent_id, $create_survey, $create_user, $delete_user);
    }

    /**
     * Execute an INSERT SQL statement an returns the newly created id.
     *
     * @param string $query Expect an INSERT SQL statement
     * @return int|bool Returns the newly created id in case of success. False otherwise.
     */
    public static function insert($query) {
        if (self::execute($query)) {
            return self::get_insert_id();
        } else {
            return false;
        }
    }

    /**
     * Execute a SQL command string.
     *
     * @global object $connect
     * @param string $query
     * @return any
     */
    public static function execute($query) {
        global $connect;
        $result = $connect->Execute($query);
        if (!$result) {
            echo '<br />' . $connect->ErrorMsg();
            echo'<br />' . $query. '<br />';
        }

        return $result;
    }

    /**
     * Returns the latest inserted primary id for the user table.
     *
     * @global object $connect
     * @return int
     */
    public static function get_insert_id() {
        global $connect;
        return $connect->Insert_ID(self::get_table_name(), self::PRIMARY_KEY);
    }

    /**
     * Quote $text.
     * 
     * @param string $text
     * @return string
     */
    public static function quote($text) {
        return "'" . db_quote($text) . "'";
    }

}

?>
