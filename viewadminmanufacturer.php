<?php
    session_start();

    if (isset($_SESSION['type'])) {
      if($_SESSION['type']=='Seller'){

        $username = "root";
        $password = "";
        $hostname = "localhost";

        $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

        $selected = mysql_select_db("vintagebikes", $dbhandle);

        if(isset($_POST['delete_bike'])) {
            //If user presses delete button (defined in table prined below
            $d_query = "DELETE FROM `vintagebikes`.`bikeproposed` WHERE `bikeproposed`.`bike_id` = '$_POST[bike_id]'";
            $result = mysql_query($d_query);
            unset($_POST['delete_project']);
        }
        //If _POST is 'empty'
        $query = "SELECT * FROM `bikeproposed`";
        $result = mysql_query($query);
      }
    }
    else
      header("location:index.php");
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
              <li class="active"><a href="#">View Sales</a></li>
              <li ><a href="seller.php">Sell a Bike</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION["name"];?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Change Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </nav>
        <div id="page-content-wrapper" class ="col-md-8 centered">

            <?php
                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Model</th>
                <th>Manufacturer</th>
                <th>Year</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Delete Proposal</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysql_fetch_assoc($result)) {
                    
                    if ($row['accepted'] == 1){
                      echo "<tr class = 'success'>";
                    }
                    else if ($row['accepted'] == 2){
                      echo "<tr class = 'danger'>";
                    }
                    else 
                      echo "<tr>";
                    echo "<form action='viewseller.php' method='POST'>";
                    
                    echo "<td>" . $row['model'] . " </td>";
                    echo "<td>" . $row['manufacturer'] . " </td>";
                    echo "<td>" . $row['year'] . " </td>";
                    echo "<td>" . $row['description'] . " </td>";
                    echo "<td>" . $row['cost'] . " </td>";
                    if ($row['accepted']){
                      echo "<td>" . "<button type='submit' class='btn btn-success' name='delete_bike'>Remove</button></td>";                      
                    }
                    else
                      echo "<td>" . "<button type='submit' class='btn btn-danger' name='delete_bike'>&nbspDelete&nbsp</button></td>";
                    echo "<td>" . "<input type='hidden' name='bike_id' value='" . $row['bike_id'] . "'> </td>";
                    echo "</form>";
                    echo "</tr>";
                }
                echo "</tbody></table>";

                mysql_close();

            ?>
        </div>
    </body>
</html>