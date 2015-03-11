<?php
	echo "here";
	session_start();
    // $seconds = -10 + time();
    // setcookie(loggedin, date("F jS - g:i a"), $seconds);
	session_unset();
    header("location: index.php")
?>