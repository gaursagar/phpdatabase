<?php
    session_start();

    if (isset($_SESSION['type'])) {
      $username = "root";
      $password = "";
      $hostname = "localhost";

      $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

      $selected = mysql_select_db("vintagebikes", $dbhandle);

      if($_SESSION['type']=='Manufacturer'){
        if(isset($_POST["accept_spare"])) {

              unset($_POST["accept_spare"]);
              //Update Tables
              $i_query ="INSERT INTO `vintagebikes`.`spare` (`spare_id`, `name`, `cost`, `total_stock`, `description`) 
                  SELECT `spare_id`, `name`, `cost`, `total_stock`, `description` 
                  FROM `vintagebikes`.`spareproposed` 
                  WHERE `spare_id` = '$_POST[spare_id]'";

              $result  = mysql_query($i_query);
              $u_query = "UPDATE `vintagebikes`.`spare` SET `client_id` = '$_SESSION[id]' WHERE `spare`.`spare_id` = '$_SESSION[id]";
              $result  = mysql_query($u_query);
              $d_query = "UPDATE `vintagebikes`.`spareproposed` SET `accepted` = '1' WHERE `spareproposed`.`spare_id` = '$_POST[spare_id]'";
              $result = mysql_query($d_query);
        }
          //If _POST is 'empty'
          $query = "SELECT * FROM `spareproposed` WHERE `accepted`='0'";
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
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome Seller <b class="caret"></b></a>
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
                <th>Name</th>
                <th>Cost</th>
                <th>Number Required</th>
                <th>Total Cost</th>
                <th>Description</th>                
                </tr>
                </thead>
                <tbody>";

                while($row = mysql_fetch_assoc($result)) {
                    if ($row['accepted']==0){
                      echo "<tr>";
                      echo "<form action='manufacturer.php' method='POST'>";
                      
                      echo "<td>" . $row['name'] . " </td>";
                      echo "<td>" . $row['cost'] . " </td>";
                      echo "<td>" . $row['total_stock'] . " </td>";
                      echo "<td>" . ($row['total_stock']*$row['cost']) . " </td>";
                      echo "<td>" . $row['description'] . " </td>";
                      echo "<td>" . "<button type='submit' class='btn btn-success' name='accept_spare'>Accept</button></td>";
                      echo "<td>" . "<input type='hidden' name='spare_id' value='" . $row['spare_id'] . "'> </td>";
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