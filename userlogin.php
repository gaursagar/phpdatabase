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

    $query = "SELECT * FROM `vintagebikes`.`client` WHERE username='$myusername' and password='$mypassword'";
    $result = mysql_query($query);
    $count = mysql_num_rows($result);
    echo $query;
    mysql_close();    
    if ($count == 1){
        $row = mysql_fetch_assoc($result);

        if($row['type'] == 'Buyer'){
            $_SESSION['name'] = $myusername;
            $_SESSION['type'] = $row['type'];
            $_SESSION['id'] = $row['client_id'];
            header("location:buyer.php");
        }
        else if($row['type'] == 'Seller'){
            echo $row["type"];
            $_SESSION['name'] = $myusername;
            $_SESSION['type'] = $row['type'];
            $_SESSION['id'] = $row['client_id'];
            header("location:seller.php");
        }
        else if($row['type'] == 'Manufacturer'){
            $_SESSION['name'] = $myusername;
            $_SESSION['type'] = $row['type'];
            $_SESSION['id'] = $row['client_id'];
            header("location:manufacturer.php");
        }
        else{
            header("location:index.php");
        }
    }
    else{
        header("location:index.php");
    }
?>