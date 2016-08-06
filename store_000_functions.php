<?php
function sanitize_string($var)
{
    if(get_magic_quotes_gpc())
    {
        $var = stripslashes($var);
    }
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
}

function sanitize_mysql($var)
{
    $var = mysql_real_escape_string($var);
    $var = sanitze_string($var);
    return $var;
}
?>