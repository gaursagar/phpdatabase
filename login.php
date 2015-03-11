<?php
	session_start();
    $username = "root";
    $password = "";
    $hostname = "localhost";

    $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

    $selected = mysql_select_db("vintagebikes", $dbhandle);

    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    $myusername = stripslashes($myusername);
    $mypassword = stripcslashes($mypassword);

    $query = "SELECT * FROM admin_password WHERE username='$myusername' and password='$mypassword'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);

    mysql_close();    
    if ($count == 1){
        // $seconds = 1000 + time();
        // setcookie(loggedin, date("F jS - g:i a"), $seconds);
        $_SESSION['Admin'] = $myusername;
        header("location:viewemployee.php");
    }
    else{
        header("location:index.php");
    }
?>