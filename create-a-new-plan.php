<?php
    require 'includes/common.php';
    if (!isset($_SESSION['email'])) {
        header('location: login.php');
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
        <title>Create A New Plan</title>
        <style>
            .button {
                background-color: #4D774F;
                color: white;
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
              }

              .button1 {
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
        <!--*************************Header**********************************-->
        <?php
        include 'includes/header.php';
        ?>
        <!--************************Panel************************************-->
        <!--Alert msg-->
            <?php
                if(isset($_GET['msg']))
                {
                    $msg = $_GET['msg'];
                    echo  "<script>alert('$msg')</script>";
                }
            ?>
        
        
        <div class="row " >
            <div class="container-fluid">
                <div class='col-xs-4'>

                </div>
                <div class="col-xs-4" id="login-panel">
                    <div class="panel">
                        <div class="panel-heading" style="background-color:#4D774F;color:#ffffff;">
                            <center><h4>Create A New Plan</h4></center>
                            <?php $uid = $_SESSION['user_id'];?>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="new-plan.php">
                        <!--initial budget-->
                            <div class="form-group">
                                <label for="initial_budget">Initial Budget</label>
                                <input type="number" class="form-control" name="initial_budget" placeholder="Initial Budget(Ex. 4000)" min="50" required="true">
                            </div>
                        <!--no of people-->
                            <div class="form-group">
                                <label for="no_of_people">How many people you want to add in your group?</label>
                                <input type="number" class="form-control" name="no_of_people" placeholder="No. of people" min="1" required="true">
                            </div>
                            
                        <!--Next button-->           
                            <button class="button button1">Next</button>
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