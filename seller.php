<?php
    session_start();

    if (isset($_SESSION['type'])) {
      if($_SESSION['type']=='Seller'){
        if(isset($_POST["submit"])) {
          // unset($_POST["submit"]);
          echo "here";
          $username = "root";
          $password = "";
          $hostname = "localhost";
  
          $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");
  
          $selected = mysql_select_db("vintagebikes", $dbhandle);
  
          $model        = $_POST['model'];
          $year         = $_POST['year'];
          $cost         = $_POST['cost'];   //Make Sure Date Format is Correct
          $description  = $_POST['description'];
          $manufacturer = $_POST['manufacturer'];
          $distance     = $_POST['distance'];
  
          //To avoid SQL injection
          $model        = stripslashes($model);
          $year         = stripslashes($year);
          $cost         = stripslashes($cost);   //Make Sure Date Format is Correct
          $description  = stripslashes($description);
          $manufacturer = stripslashes($manufacturer);
          $distance     = stripslashes($distance);
          $client_id    = $_SESSION["id"];
          //Disallow Null Values to be inserted
          if ($model != "" && $year != "" && $cost != "" && $manufacturer != "" && $distance !="") {
              $query = "INSERT INTO `vintagebikes`.`bikeproposed` 
                (`bike_id`, `model`, `year`, `cost`, `description`, `manufacturer`, `distance_run`, `client_id`) 
                VALUES (NULL, '$model', '$year', '$cost', '$description', '$manufacturer', '$distance', '$client_id');";
              // echo $query;
              $result = mysql_query($query);
              mysql_close();
              if ($result == 1) {
                header("location:viewseller.php");
              }
              else{
                header("location:seller.php");
              }
          }
      }
    }
  }
  else{
    header("location:index.php");
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
        <ul class="nav navbar-nav nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
            <ul class="dropdown-menu ">
              <li><a href="viewseller.php">View Sales</a></li>
              <li class="active"><a href="#">Sell a Bike</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome Admin <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>

    <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 centered">
                        <form action = "seller.php" class="well" method = "POST">
                            <div class="form-group">
                                <label>Model</label>
                                <input type="text" class="form-control" name="model" placeholder="Model">
                            </div>
                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" class="form-control" name="year" placeholder="Year of Manufacture" min="1960" max="2050">
                            </div>
                            <div class="form-group">
                                <label>Cost</label>
                                <input type="number" class="form-control" name="cost" placeholder="Proposed Selling Price" min="0">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="description" placeholder="Description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Manufacturer</label>
                                <input type="text" class="form-control" name= "manufacturer" placeholder="Manufacturer">
                            </div>
                            <div class="form-group">
                                <label>Distance Travelled</label>
                                <input type="number" class="form-control" name= "distance" min="0">
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </body>
</html>