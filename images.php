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

    if(isset($_POST["submit"])) {
    	$imageName = mysql_real_escape_string($_FILES["image"]["name"]);
    	$imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
    	$imageType = mysql_real_escape_string($_FILES["image"]["type"]);

    	if(substr($imageType,0,5) == "image")
    	{
    		$result = mysql_query("INSERT INTO `vintagebikes`.`image` VALUES('NULL','$imageName','$imageData')");
    		if($result) {
    			echo "Inserted";
    		}

    	}

    	else {
    		echo "only images are allowed";
    	}
    }

    // $name        = $_POST['name'];
    // $price       = $_POST['price'];
    // $description = $_POST['description'];
    // $discount    = $_POST['discount'];
    // $project     = $_POST['project_id'];

    // //To avoid SQL injection
    // $name        = trim(stripslashes($name));
    // $price       = stripcslashes($price);
    // $description = stripcslashes($description);
    // $discount    = stripcslashes($discount);
    // $project     = stripcslashes($project);

    // //Disallow Null Values to be inserted
    // if ($name == "" || $price == "" || $discount == "" || $project == "") {
    //     header("location:createproduct.php");
    // }

    // //$query = "SELECT * FROM  WHERE username='$myusername' and password='$mypassword'";
    // $query = "INSERT INTO `vintagebikes`.`product` 
    //     (`product_id`, `name`, `price`, `discount`, `description`, `project_id`)
    //     VALUES (NULL, '$name', '$price', '$discount', '$description', '$project');";
    // $result = mysql_query($query);
    // if ($result == 1) {
    //     echo "Record added";
    // }

    mysql_close();
?>

<html lang="en">
	<body>
		<form action="images.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="image">
			<input type="submit" name="submit">
		</form>
		<img src="showimage.php?id=4">
	</body>
</html>