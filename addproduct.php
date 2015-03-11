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

    $name        = $_POST['name'];
    $price       = $_POST['price'];
    $description = $_POST['description'];
    $discount    = $_POST['discount'];
    $project     = $_POST['project_id'];

    //To avoid SQL injection
    $name        = trim(stripslashes($name));
    $price       = stripcslashes($price);
    $description = stripcslashes($description);
    $discount    = stripcslashes($discount);
    $project     = stripcslashes($project);

    //Disallow Null Values to be inserted
    if ($name == "" || $price == "" || $discount == "" || $project == "") {
        header("location:createproduct.php");
    }

    //$query = "SELECT * FROM  WHERE username='$myusername' and password='$mypassword'";
    $query = "INSERT INTO `vintagebikes`.`product` 
        (`product_id`, `name`, `price`, `discount`, `description`, `project_id`)
        VALUES (NULL, '$name', '$price', '$discount', '$description', '$project');";
    $result = mysql_query($query);
    if ($result == 1) {
        header("location:viewproduct.php");
    }

    mysql_close();
?>