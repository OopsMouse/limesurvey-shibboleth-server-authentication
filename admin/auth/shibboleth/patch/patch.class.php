<?php

/**
 * Apply the patch.
 * 
 * add the following line
 * 
 *         require_once(dirname(__FILE__) . '/auth/shibboleth/login_check.php'); 
 * 
 *   in
 * 
 *         limesurvey/admin/admin.php
 * 
 *   after
 * 
 *         if($casEnabled==true)
 *         {
 *              include_once("login_check_cas.php");
 *         }
 *         else
 *         {
 *              include_once('login_check.php');
 *         }
 * 
 *         add line here
 * 
 *     around line 70
 *
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class Patch
{

    public static function check()
    {
        return is_readable(self::get_path());
    }

    /**
     * Apply the patch
     */
    public static function apply()
    {
        self::remove();
        $path = self::get_path();
        $content = file_get_contents($path);
        $text = self::get_text();
        $pattern = '/' . preg_quote("include_once('login_check.php');") . '\s*}/';

        $matches = preg_split($pattern, $content);
        if (count($matches) == 2)
        {
            $content = reset($matches) . "include_once('login_check.php');\n}\n" . $text . end($matches);
            file_put_contents($path, $content);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Remove the patch.
     */
    public static function remove()
    {
        $path = self::get_path();
        $text = self::get_text();

        $content = file_get_contents($path);
        $content = str_ireplace($text, '', $content);
        $content = str_ireplace("\n\n", "\n", $content);
        file_put_contents($path, $content);
    }

    /**
     * Text to include.
     * 
     * @return string
     */
    public static function get_text()
    {
        $lines = array();

        $lines[] = '';
        $lines[] = "//START OF SHIBBOLETH PATCH";
        $lines[] = "require_once(dirname(__FILE__) . '/auth/shibboleth/login_check.php');";
        $lines[] = "//END OF SHIBBOLETH PATCH";
        $lines[] = '';
        return implode("\n", $lines);
    }

    /**
     * Path to the file that must be modified.
     * @return string
     */
    public static function get_path()
    {
        $admin_root = dirname(dirname(dirname(dirname(__FILE__))));
        return realpath($admin_root . '/admin.php');
    }

}

?>