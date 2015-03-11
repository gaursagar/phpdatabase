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
    </nav>

    <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 centered">
                        <form action = "addemployee.php" class="well" method = "POST">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="contact" placeholder="Contact">
                            </div>
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" name="dob" placeholder="Date of Birth">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea type="text" class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text" class="form-control" name="gender" placeholder="Gender">
                            </div>
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="number" class="form-control" name="address" placeholder="Salary" min="0">
                            </div>
                             <div class="form-group">
                                <label>Remarks</label>
                                <textarea type="text" class="form-control" name="remarks" placeholder="Remarks" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Record</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>