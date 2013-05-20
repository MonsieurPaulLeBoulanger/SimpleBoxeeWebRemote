<?php

function getServer()
{
	include 'config.php';

    $server = "http";

    if (isset($_SERVER["HTTPS"]) )
    {
        $server .= "s";
    }

    if (!empty($boxee_user_pass))
    {
        $boxee_user_pass .= '@';
    }

    $server .= "://".$boxee_user_pass.$_SERVER["SERVER_ADDR"].':'.$_SERVER["SERVER_PORT"].substr($_SERVER["PHP_SELF"],0, strrpos( $_SERVER["PHP_SELF"],"/"));

	return $server;
}


?>
