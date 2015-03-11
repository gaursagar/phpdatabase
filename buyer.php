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
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome User <b class="caret"></b></a>
                </li>
                <li>
                    <a href = "logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-10">


                <div class="row">
                    <?php
                        while($row = mysql_fetch_assoc($result))
                        {
                            echo "
                            <div class='col-sm-4 col-lg-6 col-md-4'>
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
                                        <form action='buyer.php' method='POST'>
                                            <input type='hidden' name='product_id' value='" . $row['product_id'] . " '>
                                            <button type='submit' class='btn btn-sm btn-success'>Purchase</button>
                                        </form>
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
