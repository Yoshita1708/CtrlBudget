<!--including database-->
<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
    {
        header('location: login.php');
    }
?>

<!--*************************creating layout*********************************-->

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        
        <title>Home</title>
        
        <style>
            #create-icon{   
                position: fixed;
                right: 10px;
                padding-bottom: 10px;
                font-size:60px;
                color:#000000;
                bottom: 15px;
            }
            #icon-color{
                color:#4D774F;
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
    <!--############################----BODY----#############################-->
    
    <body id="background_clr">
        
    <!--*****************************Header**********************************-->
        <?php
        include 'includes/header.php';
        ?>
    
    <!--*****************************Content*********************************-->
        <!--Alert msg-->
            <?php
                if(isset($_GET['msg']))
                {
                    $msg = $_GET['msg'];
                    echo  "<script>alert('$msg')</script>";
                }
            ?>
        
        
        <?php 
            $user_id = $_SESSION['user_id'];
            $select_query = "SELECT note_id, user_id,initial_budget,no_of_people,title,DATE_FORMAT(from_date,'%D %b'),"
                    . " DATE_FORMAT(to_date,'%D %b %Y') FROM `budget_index` WHERE user_id='$user_id'";
            $select_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
            $total_num_rows_fetched = mysqli_num_rows($select_result);
            if($total_num_rows_fetched==0)//This means that there are no plans
            {
        ?>
                <!--___________________________NO PLANS______________________________-->
                <div class="row">
                    <div class="container">
                        <p style="margin-top: 100px; font-size: 25px">You don't have any active plans</p>
                        <div class="col-xs-3"></div>

                        <div class="col-xs-3" style="margin-top: 20px;">
                            <center>
                            <div class="panel">
                                <div class="panel-body" style="height: 200px">
                                    <center>
                                        <div class="row" style="height: 70px;"></div>

                                        <a href="create-a-new-plan.php" ><span class="glyphicon glyphicon-plus-sign"></span>Create a New Plan</a>

                                    </center>
                                </div>
                            </div>
                            </center>
                        </div>
                    </div>
                </div>
        <?php
            }
            else //This means that there is atleast one plan
            {               
        ?>
                <!--________________________WITH PLANS_______________________-->
                <div class="row">
                    <div class="container">
                        <h2 style="margin-top: 100px; color: #000000;">Your Plans</h2>
                        <?php    
                               
                            for($i=0;$i<$total_num_rows_fetched;$i++)
                            {//Fetching data for each plan
                                $row = mysqli_fetch_row($select_result); 
                                $initial_budget = $row[2];
                                $no_of_people = $row[3];
                                $title = $row[4];
                                $from = $row[5];
                                $to = $row[6];
                                $nid = $row[0];
                        ?>
                        <div class="col-sm-3" style="margin-top: 30px;">
                            <div class="panel panel-default">
                            <!--panel heading-->
                                <div class="panel-heading" style="background-color: #4D774F;; color:#ffffff;padding-bottom: 2px">
                                    <center>
                                        <p><?php echo $title;?>
                                            <span class="glyphicon glyphicon-user" style="float: right;"><?php echo " $no_of_people"?></span>
                                        </p>
                                    </center>
                                 
                                </div>
                            <!--panel body-->
                                <div class="panel-body">
                                    <div>
                                        <p>Budget<span style="float: right;">&#8377 <?php echo $initial_budget;?></span></p>
                                        <p>Date<span style="float: right;"><?php echo $from." - ".$to;?></span></p>
                                    </div>
                                
                                    <?php
                                    echo "<a href='view-plan.php?note_id=$nid'><button class='button1'>View Plan</button></a>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        <footer>
                        <div id="create-icon">
                    
                            <a href="create-a-new-plan.php"><span class="glyphicon glyphicon-plus-sign" id="icon-color"></span></a>
                    
                        </div>
                        </footer>
                    </div> 
                </div>
                
            <?php }?> 
                
    <!--*****************************Footer*******************************--> 
    <?php
        include 'includes/footer.php';
    ?>
    </body>
    
</html>


