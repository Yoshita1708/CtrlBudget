<?php
    require 'includes/common.php';
?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Control Budget</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!--*********************************Header*********************************-->
        <?php
        include 'includes/header.php';
        ?>
        <!--*********************************Content*********************************-->
        <div class="row" id="banner_image">
            <div class="container-fluid">
                <center>
                    <div id="banner_content">
                        <h2>We help you control your budget.</h2>
                        <a href="login.php" class="btn btn-success btn-lg-active">
                            Start Today
                        </a>
                    </div>
                </center>
            </div>
        </div>
        
        <!--***********************FOOTER************************************-->
        <?php
        include 'includes/footer.php';
        ?>

        
        
    </body>
</html>
