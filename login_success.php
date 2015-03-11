<?php
    session_start();

   if (!isset($_SESSION['Admin'])) {
         header("location:index.php");
    }
?>
<html>
    <body>
        Welcome Admin
        <a href="logout.php">Logout</a>
        <div id="sidebar">
            <div>Products
                <div><a href="viewproduct.php">View Products</a></div>
                <div><a href="createproduct.php">Create New Product</a></div>
            </div>
            <div>Employee
                <div><a href="viewemployee.php">View Employee</a></div>
                <div><a href="createemployee.php">Add New Employee</a></div>
            </div>
            <div>
                Projects
                <div>View Projects</div>
                <div>Start New Project</div>
            </div>
            <div>
                Spare Parts
                <div>View Spares</div>
                <div>Order New</div>
            </div>
            <div>
                Clients
                <div>Customers</div>
                <div>Bike Sellers</div>
                <div>Manufacturers</div>
            </div>
            <div>
                Sales
            </div>
        </div>
    </body>
</html>