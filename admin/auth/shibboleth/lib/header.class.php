<?php

/**
 * Utility class to manage http headers.
 * 
 * @copyright (c) 2011 University of Geneva
 * @license GNU General Public License - http://www.gnu.org/copyleft/gpl.html
 * @author Laurent Opprecht
 */
class Header{
    
    /**
     * Redirect to a url. If $url is not provider redirect to $rooturl.
     *
     * @global string $rooturl
     * @param string $url
     */
    static function redirect($url = '')
    {
        global $rooturl;
        $url = $url ? $url : $rooturl;
        header('Location: ' . $url);
    }
    
}
?>
