<?php
    session_start();

    if (!isset($_SESSION['Admin'])) {
         header("location:index.php");
    }

    $username = "root";
    $password = "";
    $hostname = "localhost";

    $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

    $selected = mysql_select_db("vintagebikes", $dbhandle);

    $name          = $_POST['name'];
    $cost_estimate = $_POST['cost_estimate'];
    $date_started  = $_POST['date_started'];
    $deadline      = $_POST['deadline'];
    $description   = $_POST['description'];
    $bike_id       = $_POST['bike_id'];

    //To avoid SQL injection
    $name          = stripslashes($name);
    $cost_estimate = stripcslashes($cost_estimate);
    $date_started  = stripcslashes($date_started);
    $deadline      = stripcslashes($deadline);
    $bike_id       = stripcslashes($bike_id);
    $description   = stripcslashes($description);

    //Disallow Null Values to be inserted
    if ($name == "" || $cost_estimate == "" || $deadline == "" || $bike_id == "" || $date_started == "") {
        header("location:createproject.php");
    }

    //$query = "SELECT * FROM  WHERE username='$myusername' and password='$mypassword'";
    $query = "INSERT INTO `vintagebikes`.`project` 
        (`project_id`, `name`, `cost_estimate`, `deadline`, `date_started`, `bike_id`, `description`)
        VALUES (NULL, '$name', '$cost_estimate', '$deadline', '$date_started', '$bike_id', '$description');";

    $result = mysql_query($query);
    if ($result == 1) {
        header("location:viewproject.php");
    }

    mysql_close();
?>