<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
    {
        header("Location: login.php");
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
        <title>Change Password</title>
        
        <style>
            .button1 {
                
                
                padding: 6px 20px;
                text-align: center;
                text-decoration: none;
                display: block;
                font-size: 14px;
                margin: 2px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                border-radius: 4px;
                width: 100%;
                
                background-color: white; 
                color: #4D774F; 
                border: 2px solid #4D774F;

              }
              
              .button1:hover {
                background-color: #4D774F;
                color: white;
              }

        </style>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body id="background_clr">
        
        <!--***************HEADER********************************************-->
        <?php
            include 'includes/header.php';
        ?>
        <!--*************************CONTENT*********************************-->
        <div class="row">
            <div class="container">
                <div class='col-xs-4'>

                </div>
                <div class="col-xs-4" id="login-panel">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: #ffffff;">
                            <center><h3>Change Password</h3></center>
                        </div>
                        <div class="panel-body">
                        <!--Old password-->    
                            <form method="POST" action="password-script.php">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" class="form-control" name="old_password" placeholder="Old Password" required="true">
                                </div>
                            <!--new password-->
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" name="new_password" placeholder="New Password" 
                                            required="true">
                                    
                            <!--Confirm password-->
                                </div>
                                <div class="form-group">
                                    <label for="retypr_new_password">Confirm New Password</label>
                                    <input type="password" class="form-control" name="retype_new_password"
                                           placeholder="Re-type New Password" required="true">
                                    
                                </div>
                            <!--Alert msg-->
                                <?php
                                if(isset($_GET['msg']))
                                {
                                    $msg = $_GET['msg'];
                                    echo  "<script>alert('$msg')</script>";
                                }
                            ?>  
                                <button type="submit" class="button1">Change</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
        <!--***********************FOOTER************************************-->
        <?php
        include 'includes/footer.php';
        ?>
        
    </body>
</html>


