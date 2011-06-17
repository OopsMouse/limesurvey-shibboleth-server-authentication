<!--
Web page used to apply the patch.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once dirname(__FILE__) . '/../main.php';
        require_once dirname(__FILE__) . '/patch.class.php';
        if(! Patch::check()){
            echo 'The following file is not writable by the webserver. Ensure the webserver has enough rights and that the file has the correct attributes';
            echo '<br/>';
            echo Patch::get_path();
            die;
        }
        if (Patch::apply())
        {
            echo 'Patch success';
        }
        else
        {
            echo 'Patch failed';
        }
        ?>
    </body>
</html>
