<?php
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != 'zaz' || !isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW'] != 'Ilovemylittleponey')
{
        header('WWW-Authenticate: Basic realm=\'\'Member area\'\'');
        header('HTTP/1.0 401 Unauthorized');
        echo "<html><body>That area is accessible for members only</body></html>\n";
}
else
{
        $file = base64_encode(file_get_contents("../img/42.png"));
        echo ("<html><body>\n");
        echo ("Hello Zaz<br />\n");
        echo ("<img src='data:image/png;base64,$file'>\n");
        echo ("</body></html>");
}
?>
