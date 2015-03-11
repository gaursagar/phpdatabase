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

    if(isset($_POST['update_employee'])) {
        // Query susceptible to sql injection need to be changed
        $u_query = "UPDATE `vintagebikes`.`employee` SET `name` = '$_POST[name]', `contact` = '$_POST[contact]',
            `dob` = '$_POST[dob]', `gender` = '$_POST[gender]',
            `salary` = '$_POST[salary]', `date_joined` = '$_POST[date_joined]',
            `address` = '$_POST[address]', `remarks` = '$_POST[remarks]'
            WHERE `employee`.`employee_id` = '$_POST[employee_id]';";

        $result = mysql_query($u_query);
        unset($_POST['update_employee']);
    }

    else if(isset($_POST['delete_employee'])) {
        //If user presses delete button (defined in table prined below
        $d_query = "DELETE FROM `vintagebikes`.`employee` WHERE `employee`.`employee_id` = '$_POST[employee_id]'";
        $result = mysql_query($d_query);
        unset($_POST['delete_employee']);
    }
    //If _POST is 'empty'
    $query = "SELECT * FROM `employee`";
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
              <li class="dropdown active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employee <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="active"><a href="viewemployee.php">View Employees</a></li>
                  <li><a href="createemployee.php">Add New Employee</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="viewproduct.php">View Products</a></li>
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
                  <li><a href="adminseller.php">Bike Sellers</a></li>
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
                
                <thead><tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Salary</th>
                <th>Joined</th>
                <th>Remarks</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysql_fetch_assoc($result)) {
                    echo "<form action='viewemployee.php' method='POST'>";
                    echo "<tr>";
                    echo "<td>" . "<input type='text' class='form-control' name='name' value='" . $row['name'] . "'> </td>";
                    echo "<td>" . "<input type='number' class='form-control' name='contact' value='" . $row['contact'] . "'> </td>";
                    echo "<td>" . "<input type='date' class='form-control' name='dob' value='" . $row['dob'] . "'> </td>";
                    echo "<td>" . "<input type='text' class='form-control' name='address' value='" . $row['address'] . "'> </td>";
                    echo "<td>" . "<input type='text' class='form-control' name='gender' value='" . $row['gender'] . "'> </td>";
                    echo "<td>" . "<input type='number' class='form-control' name='salary' value='" . $row['salary'] . "'> </td>";
                    echo "<td>" . "<input type='date' class='form-control' name='date_joined' value='" . $row['date_joined'] . "'> </td>";
                    echo "<td>" . "<input type='text' class='form-control' name='remarks' value='" . $row['remarks'] . "'> </td>";
                    echo "<td>" . "<button type='submit' class='btn btn-success' name='update_employee'>Update</button></td>";
                    echo "<td>" . "<button type='submit' class='btn btn-danger' name='delete_employee'>Delete</button></td>";
                    echo "<td>" . "<input type='hidden' name='employee_id' value='" . $row['employee_id'] . "'> </td>";
                    echo "</form>";
                    echo "</tr>";
                }
                echo "</thead></table>";

                mysql_close();

            ?>
        </div>
    </body>
</html>