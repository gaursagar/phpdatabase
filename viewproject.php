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

    if(isset($_POST['update_project'])) {
        // Query susceptible to sql injection need to be changed
        $u_query = "UPDATE `vintagebikes`.`project` SET `name` = '$_POST[name]', `cost_estimate` = '$_POST[cost_estimate]',
            `date_started` = '$_POST[date_started]', `deadline` = '$_POST[deadline]',
            `description` = '$_POST[description]', `bike_id` = '$_POST[bike_id]'  
            WHERE `project`.`project_id` = '$_POST[project_id]';";

        $result = mysql_query($u_query);
        unset($_POST['update_project']);
    }

    else if(isset($_POST['delete_project'])) {
        //If user presses delete button (defined in table prined below
        $d_query = "DELETE FROM `vintagebikes`.`project` WHERE `project`.`project_id` = '$_POST[project_id]'";
        $result = mysql_query($d_query);
        unset($_POST['delete_project']);
    }
    //If _POST is 'empty'
    $query = "SELECT * FROM `project`";
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
                <tr>
                <thead>
                <tr>
                <th>Name</th>
                <th>Cost Estimate</th>
                <th>Date Started</th>
                <th>Deadline</th>
                <th>Description</th>
                <th>BikeID</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysql_fetch_assoc($result)) {
                    echo "<form action='viewproject.php' method='POST'>";
                    echo "<tr>";
                    echo "<td>" . "<input type='text' class='form-control' name='name' value='" . $row['name'] . "'> </td>";
                    echo "<td>" . "<input type='number' class='form-control' name='cost_estimate' value='" . $row['cost_estimate'] . "'> </td>";
                    echo "<td>" . "<input type='date' class='form-control' name='date_started' value='" . $row['date_started'] . "'> </td>";
                    echo "<td>" . "<input type='date' class='form-control' name='deadline' value='" . $row['deadline'] . "'> </td>";
                    echo "<td>" . "<textarea class='form-control' name='description' rows = '1'>" . $row['description'] . "</textarea> </td>";
                    echo "<td>" . "<input type='number' class='form-control' name='bike_id' value='" . $row['bike_id'] . "' min='0'> </td>";
                    echo "<td>" . "<button type='submit' class='btn btn-success' name='update_project'>Update</button></td>";
                    echo "<td>" . "<button type='submit' class='btn btn-danger' name='delete_project'>Delete</button></td>";
                    echo "<td>" . "<input type='hidden' name='project_id' value='" . $row['project_id'] . "'> </td>";
                    echo "</form>";
                    echo "</tr>";
                }
                echo "</thead></table>";

                mysql_close();

            ?>
        </div>
    </body>
</html>