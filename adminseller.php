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

    if(isset($_POST['delete_bike'])) {
        //If user presses delete button 
        //Accepted = 0 ==> Not Yet Considered, 1 ==> Accepted, 2 ==> Declined
        $d_query = "UPDATE `vintagebikes`.`bikeproposed` SET `accepted` = '2' WHERE `bikeproposed`.`bike_id` = '$_POST[bike_id]'";
        $result = mysql_query($d_query);
        unset($_POST['delete_bike']);
    }
    if(isset($_POST['accept_bike'])) {
        //If user presses delete button (defined in table prined below
        $d_query = "UPDATE `vintagebikes`.`bikeproposed` SET `accepted` = '1' WHERE `bikeproposed`.`bike_id` = '$_POST[bike_id]'";
        $result  = mysql_query($d_query);
        $i_query = "INSERT INTO `vintagebikes`.`bike`
              SELECT `bike_id`, `model`, `year`, `cost`, `description`, `manufacturer`, `distance_run`, `client_id` 
              FROM `vintagebikes`.`bikeproposed` WHERE `bike_id` = '$_POST[bike_id]'";
        $result  = mysql_query($d_query);
        unset($_POST['accept_bike']);
    }
    //If _POST is 'empty'
    $query = "SELECT * FROM `bikeproposed`";
    $result = mysql_query($query);
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
              <li></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employee <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="viewemployee.php">View Employees</a></li>
                  <li><a href="createemployee.php">Add New Employee</a></li>
                </ul>
              </li>
              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="active"><a href="viewproduct.php">View Products</a></li>
                  <li><a href="createproduct.php">Add New Product</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Project <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="viewproject.php">View Current Projects</a></li>
                  <li><a href="createproject.php">Start New Project</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Spares <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="orderspare.php">Order New Spare</a></li>
                  <li><a href="viewspare.php">View Current Stock</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clients <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="customer.php">Customer</a></li>
                  <li><a href="seller.php">Bike Sellers</a></li>
                  <li><a href="manufacturer.php">Manufactureres</a></li>
                </ul>
              </li>
              <li><a href="#">Sales</a></li>
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

           <?php
                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Model</th>
                <th>Manufacturer</th>
                <th>Year</th>
                <th>Description</th>
                <th>Cost</th>
                <th>ClientID</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysql_fetch_assoc($result)) {
                    if ($row['accepted']==0){
                      echo "<tr>";
                      echo "<form action='adminseller.php' method='POST'>";
                      
                      echo "<td>" . $row['model'] . " </td>";
                      echo "<td>" . $row['manufacturer'] . " </td>";
                      echo "<td>" . $row['year'] . " </td>";
                      echo "<td>" . $row['description'] . " </td>";
                      echo "<td>" . $row['cost'] . " </td>";
                      echo "<td>" . $row['client_id'] . " </td>";
                      echo "<td>" . "<button type='submit' class='btn btn-success' name='accept_bike'>Accept</button></td>";
                      echo "<td>" . "<button type='submit' class='btn btn-danger' name='delete_bike'>Decline</button></td>";
                      echo "<td>" . "<input type='hidden' name='bike_id' value='" . $row['bike_id'] . "'> </td>";
                      echo "</form>";
                      echo "</tr>";
                    }
                }
                echo "</tbody></table>";

                mysql_close();

            ?>
        </div>
    </body>
</html>