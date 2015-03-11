

<?php
    session_start();

    if (!isset($_SESSION['Admin'])) {
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
          <li></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employee <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="viewemployee.php">View Employees</a></li>
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
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Project <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="viewproject.php">View Current Projects</a></li>
              <li class="active"><a href="createproject.php">Start New Project</a></li>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 centered">
                        <form action = "addproject.php" class="well" method = "POST">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Estimated Cost</label>
                                <input type="number" class="form-control" name="cost_estimate" placeholder="Estimated Cost" min="0">
                            </div>
                            <div class="form-group">
                                <label>Date Started</label>
                                <input type="date" class="form-control" name="date_started" placeholder="Date Started">
                            </div>
                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="date" class="form-control" name="deadline" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label>BikeID</label>
                                  <input type="number" class="form-control" name="bike_id" placeholder="ID of bike being used" min="0">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="number" class="form-control" name="description" placeholder="Description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </body>
</html>