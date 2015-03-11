<?php

    $username = "root";
    $password = "";
    $hostname = "localhost";

    $dbhandle = mysql_connect($hostname, $username, $password) or die("Error Could Not Connect To Database");

    $selected = mysql_select_db("vintagebikes", $dbhandle);

    // if(isset($_POST['delete_spare'])) {
    //     //If user presses delete button (defined in table prined below
    //     $d_query = "DELETE FROM `vintagebikes`.`spare` WHERE `spare`.`spare_id` = '$_POST[spare_id]'";
    //     $result = mysql_query($d_query);
    //     unset($_POST['delete_spare']);
    // }
    //If _POST is 'empty'
    $query = "SELECT * FROM `product`";
    $result = mysql_query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vintage Rides</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/shop-homepage.css" rel="stylesheet">


</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
                <a class="navbar-brand" href="#">Vintage Rides</a>
                <a class="navbar-brand" href="adminlogin.php">Manager</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <form class="navbar-form navbar-right" action="userlogin.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control span2" placeholder="Username" name="username">
                    <input type="password" class="form-control  span2" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="signup.php"class="btn btn-success">Sign Up</a>
            </form>

            <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-right navbar-nav">
                    <li>
                        <input type= "text" name="username">
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div> -->
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="list-group">
                    <text class="list-group-item">Want to Sell your Bike?</tex>
                    <br> 
                    <a href="signup.php">Register Here</a>
                </div>

                <div class="list-group">
                    <text class="list-group-item"><a href="signup.php">Register</a> to make purchases</text>                    
                    
                </div>
            </div>

            <div class="col-md-9">


                <div class="row">
                    <?php
                        while($row = mysql_fetch_assoc($result))
                        {
                            echo "<div class='col-sm-4 col-lg-4 col-md-4'>
                                <div class='thumbnail'>
                                    <div class='caption'>
                                        <h6 class='pull-right'>";
                                            if ($row['discount'] <= 0)
                                                echo "$".$row['price'];
                                            else{
                                                echo "<s>$" . $row['price'] . "</s> <strong>$" . ((100 - $row['discount']) * (0.01) * $row['price']). "</strong>";
                                            }
                            echo        "</h6>
                                        <h4>" . $row['name'];
                                            // "First Product";
                            echo        "</h4>
                                        <p>" . $row['description'];
                                            // See more snippets like this online store item at 
                            echo        "</p>
                                    </div>
                                </div>
                            </div>";
                        }
                    ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <!-- <p>Copyright &copy; Your Website 2014</p> -->
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
