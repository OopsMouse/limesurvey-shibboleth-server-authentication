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
