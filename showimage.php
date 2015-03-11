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

    if(isset($_GET['id'])) {
    	$id = mysql_real_escape_string($_GET['id']);
    	$query = mysql_query("SELECT * FROM `vintagebikes`.`image` WHERE `id`='$_GET[id]'");
    	while($row = mysql_fetch_assoc($query)) {
    		$imageData = $row["image_data"];
    		echo "here";
    	}
    	
    	header("content-type: image/png");
    	echo $imageData;
    }
    else {
    	echo "Error";
    }
?>