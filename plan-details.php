<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
    {
        header('Location: login.php');
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
        <title>Plan Details</title>
        <style>
            .panel-style{
                width: 650px;
                margin-top: 100px;
                margin-bottom: 100px;
            }
            
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
        <!--*************************Header**********************************-->
        <?php
        include 'includes/header.php';
        ?>
        <!--************************Content**********************************-->
        <!--Alert msg-->
            <?php
                if(isset($_GET['msg']))
                {
                    $msg = $_GET['msg'];
                    echo  "<script>alert('$msg')</script>";
                }
            ?>
        
        <div class="row">
            <div class="fluid-container">
                <div class="col-xs-3"></div>
                <div class="col-xs-4">
                    <div class="panel panel-default panel-style">
                        <div class="panel-body">
                            <form method="POST" action="plan-script.php">
                            <!--title-->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter title (Ex. Trip to Goa)" required="true">       
                                </div>
                            <!--date-->
                                <div class="row">
                                    
                                    <div class="col-xs-6 form-group">
                                        <label for="from">From</label>
                                        <input type="date" class="form-control" name="from" min="01/01/2020" max="31/12/2020" required="true">
                                    </div>
                                    <div class="col-xs-6 form-group">
                                        <label for="to">To</label>
                                        <input type="date" class="form-control" name="to"  min="01-01-2020 " max="31-12-2020"  required="true">
                                    </div>
                                </div>
                            <!--Initial budget and No of people-->
                                <div class="row">
                                    <?php
                                            $user_id = $_SESSION['user_id'];
                                            $note_id = $_SESSION['note_id'];
                                            $select_query = "SELECT initial_budget, no_of_people from budget_index WHERE note_id = $note_id";
                                            $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
                                            $rows = mysqli_fetch_array($select_query_result);
                                            $initial_budget = $rows[0];
                                            $no_of_people = $rows[1];
                                            echo
                                                "<div class='col-xs-8 form-group'>
                                                    <label for='initial_budget'>Initial Budget</label>
                                                    <input type='text' class='form-control' name='initial_budget' value=$initial_budget disabled='disabled' >
                                                </div>
                                                <div class='col-xs-4 form-group'>
                                                    <label for='no_of_people'>No. of people</label>
                                                    <input type='text' class='form-control' name='no_of_people' value=$no_of_people disabled='disabled'>
                                                </div>"                        
                                     ?>
                                </div>
                            <!--Entering member name-->
                                <?php
                                    for($i=1;$i<=$no_of_people;$i++)
                                    {echo
                                        "<div class='form-group'>
                                            <label for='person'>Person $i</label>
                                            <input type='text' class='form-control' name='person$i' placeholder='Enter name of person $i' required='true'>
                                        </div>";
                                    }
                                ?>
                            <!--button-->
                                <button class="button button1">Submit</button>
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