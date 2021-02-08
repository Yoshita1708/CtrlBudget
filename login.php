<?php
    require 'includes/common.php';
    if (isset($_SESSION['email'])) {
        header('location: home.php');
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
        <title>Login</title>
        
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
                            <center><h2>LOGIN</h2></center>
                        </div>
                        <div class="panel-body">
                        <!--form-->
                            <form method="POST" action="login_submit.php">
                        <!--email-->
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required="true">
                            </div>
                        <!--password-->
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
                            </div>
                        <!--Alert msg-->
                            <?php
                                if(isset($_GET['msg']))
                                {
                                    $msg = $_GET['msg'];
                                    echo  "<script>alert('$msg')</script>";
                                }
                            ?>    
                        <!--Login button-->            
                        <button type="submit" class="btn btn-primary btn-block" style="background-color: #4D774F;">Login</button>
                        </form>
                        </div>
                    <!--panel footer-->
                        <div class="panel-footer">
                            <p>Don't have an account?<a href="signup.php"> Click here to Sign Up.</a></p>
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