<?php
    require 'includes/common.php';
    if (isset($_SESSION['email'])) {
        header('location: products.php');
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Sign Up</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body id="background_clr">
        <!--*************************Header**********************************-->
        <?php
        include 'includes/header.php';
        ?>
        <!--************************Panel************************************-->
        <div class="row " >
            <div class="container">
                <div class='col-xs-4'>

                </div>
                <div class="col-xs-4" id="login-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #ffffff;">
                            <center><h2>SIGN UP</h2></center>
                                
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="signup_script.php">
                             <!--name-->   
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" required="true">
                                </div>
                             <!--email-->
                                <div class="form-group">
                                    <label for = "email">Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Valid Email" 
                                           required="true" > 
                                </div>
                             <!--password-->
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password (Minimum 6 characters.)" required="true">
                                    
                                </div>
                             <!--phone number-->
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="number" class="form-control" name="phone_number" placeholder="Phone Number" required="true">
                                    
                                </div>
                             <!--alert msg-->
                                <?php
                                if(isset($_GET['msg']))
                                {
                                    $msg = $_GET['msg'];
                                    echo  "<script>alert('$msg')</script>";
                                }
                                ?>
                             <!--sign up button--> 
                             <button type="submit" class="btn btn-primary btn-block" style="background-color: #4D774F;">Sign up</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--****************************Footer*******************************-->
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>
