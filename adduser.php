<?php
    session_start();

    // if (!isset($_SESSION['Admin'])) {
    //      header("location:index.php");
    // }

    $username = "root";
    $password = "";
    $hostname = "localhost";

    $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

    $selected = mysql_select_db("vintagebikes", $dbhandle);

    $username = $_POST['username  '];
    $password = $_POST['password'];
    $name     = $_POST['name'];
    $type     = $_POST['type'];
    $contact  = $_POST['contact'];
    $address  = $_POST['address'];

    //To avoid SQL injection
    $username = stripslashes($username);
    $password = stripcslashes($password);
    $name     = stripcslashes($name);
    $type     = stripcslashes($type);
    $address  = stripcslashes($type);
    $contact  = stripcslashes($contact);

    //Disallow Null Values to be inserted
    if ($username == "" || $password == "" || $type == "" || $contact == "" || $name == "") {
        header("location:index.php");
    }

    //$query = "SELECT * FROM  WHERE username='$myusername' and password='$mypassword'";
    $query = "INSERT INTO `vintagebikes`.`client` (`client_id`, `username`, `password`, `name`, `contact`, `address`, `type`) VALUES (NULL, '$username', '$password', '$name', '$contact', '$address', '$type');";

    $result = mysql_query($query);
    if ($result == 1) {
        header("location:index.php");
    }

    mysql_close();
?>