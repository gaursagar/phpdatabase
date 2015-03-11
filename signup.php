<?php
    session_start();

    if (isset($_POST['submit'])) {
      $username = "root";
      $password = "";
      $hostname = "localhost";

      $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

      $selected = mysql_select_db("vintagebikes", $dbhandle);

      $username = $_POST['username'];
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
      $address  = stripcslashes($address);
      $contact  = stripcslashes($contact);

      //Disallow Null Values to be inserted
      if ($username != "" && $password != "" && $type != "" && $contact != "" && $name != "") {
          $query = "SELECT * FROM `vintagebikes`.`client` WHERE `username`='$username'";
          $result = mysql_num_rows(mysql_query($query));
          if($result >= 1){
            $Error = "Username Exists";
            unset($_POST['submit']);
          }
          else {
            $query = "INSERT INTO `vintagebikes`.`client` 
              (`client_id`, `username`, `password`, `name`, `contact`, `address`, `type`) 
              VALUES (NULL, '$username', '$password', '$name', '$contact', '$address', '$type');";
            echo $query;
            $result = mysql_query($query);
            if ($result == 1) {
              header("location:index.php");
              mysql_close();
            }
            else{
              header("location:index.php");
            }
          }
      }
    }
?>
<html>
    <head>
        <!-- Include Bootstrap CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <script src="assets/js/jquery-1.10.2.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <link href="assets/css/simple-sidebar.css" rel="stylesheet">
    </head>
    
    <body>

    <nav class="navbar-inverse navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Vintage Bikes</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
      </div><!-- /.navbar-collapse -->
    </nav>

    <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 centered">
                        <form action = "signup.php" class="well" method = "POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Contact">
                            </div>
                            <div class="form-group">
                                <label>Register as</label>
                                <select class="form-control" name="type">
                                  <option name="type">Buyer</option>
                                  <option name="type">Seller</option>
                                  <option name="type">Manufacturer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea type="text" class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
                        </form>
                        <p class="lead centered">
                        <?php
                          if(isset($Error))
                            echo "$Error";
                        ?></p>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>