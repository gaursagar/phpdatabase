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

    $name    = $_POST['name'];
    $contact = $_POST['contact'];
    $dob     = $_POST['dob'];   //Make Sure Date Format is Correct
    $gender  = $_POST['gender'];
    $salary  = $_POST['salary'];
    $remarks = $_POST['remarks'];
    $address = $_POST['address'];

    //To avoid SQL injection
    $name    = stripslashes($name);
    $contact = stripslashes($contact);
    $dob     = stripslashes($dob);   //Make Sure Date Format is Correct
    $gender  = stripslashes($gender);
    $salary  = stripslashes($salary);
    $remarks = stripslashes($remarks);

    //Disallow Null Values to be inserted
    if ($name == "" || $contact == "" || $dob == "" || $salary == "") {
        header("location:createemployee.php");
    }

    $date_joined = date('Y-m-d');
    $query = "INSERT INTO `vintagebikes`.`employee` 
    (`employee_id`, `name`, `contact`, `dob`, `address`, `gender`, `salary`, `date_joined`, `remarks`) 
    VALUES (NULL, '$name', '$contact', '$dob', '$address', '$gender', '$salary', '$date_joined', '$remarks');";
    
    $result = mysql_query($query);
    
    if ($result == 1) {
        echo "Record added";
    }
    else 
        echo "Something Went Wrong";
    mysql_close();
?>