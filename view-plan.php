<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
        header("Location:login.php");
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
        
        <title>View Plan</title>
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
              .exp-button{
                width: 200px;
              }
              #heading-style{
                background-color: #4D774F; 
                color:#ffffff;
                  
                padding-bottom: 3px;
              }
              a{
                  text-decoration: none;
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
    <?php
    //Fetching Info For The Plan
    $user_id = $_SESSION['user_id'];
    $note_id = $_GET['note_id'];
    
    $select_query = "SELECT note_id, user_id,initial_budget,no_of_people,title,DATE_FORMAT(from_date,'%D %b'),"
                    . " DATE_FORMAT(to_date,'%D %b %Y') FROM `budget_index` WHERE user_id='$user_id' and note_id='$note_id'";
    $select_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
    $row = mysqli_fetch_row($select_result); 
    $initial_budget = $row[2];
    $no_of_people = $row[3];
    $title = $row[4];
    $from = $row[5];
    $to = $row[6];
    $nid = $row[0];
    
    //Combine amount for each plan
    $select_query = "SELECT amount FROM member_expenditure WHERE note_id='$note_id'";
    $select_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
    
    $total_num_rows = mysqli_num_rows($select_result);
    $sum = 0;
    for($i=1;$i<=$total_num_rows;$i++){
        $row_amount = mysqli_fetch_row($select_result);
       
        $amount = $row_amount[0];
        $sum = $sum + $amount;
    }
    $total_expense = $sum;
    $remaining_amount = $initial_budget - $total_expense;
    ?>
     
   
    <div class="row">
        <div class="container">
            <!--_____________________first panel_____________________________-->
            <div class="col-sm-6" style="margin-top: 100px;">
                <div class="panel panel-default">
                    <!--panel heading-->
                    <div class="panel-heading" id="heading-style">
                        <center>
                            <p><?php echo $title;?>
                                <span class="glyphicon glyphicon-user" style="float: right;"><?php echo " $no_of_people"?></span>
                            </p>
                        </center>

                    </div>
                    <!--panel body-->
                    <div class="panel-body">
                        
                        <p><b><span style='float:left;'>Budget</span><span style='float:right'> &#8377 <?php echo $initial_budget;?></span></b></p><br>
                        <!--if remaining amount is positive-->
                    <?php  if($remaining_amount>0){?>
                        <p><b><span style='float:left;'></span>Remaining Amount<span style='float:right;color:#33ae33'> &#8377 <?php echo $remaining_amount;?></span></b></p>
                    <?php }  else if($remaining_amount==0){?>
                        <p><b><span style='float:left;'></span>Remaining Amount<span style='float:right'> &#8377 <?php echo $remaining_amount;?></span></b></p>
                    <?php } else{?>
                        <p><b><span style='float:left;'></span>Remaining Amount<span style='float:right;color:#f15404'> Overspent by &#8377 <?php echo abs($remaining_amount);?></span></b></p>
                    <?php }?>
                        
                        <p><b><span style='float:left;'>Date</span><span style='float:right'><?php echo $from.' - '.$to;?></span></b></p>  
                    </div>
                </div>
                
                
                <!--if expenses exist-->
                <?php
                    $fetch_details = "SELECT eid, note_id, person, title, DATE_FORMAT(spend_date,'%D %b %Y'), amount, bill FROM member_expenditure WHERE note_id=$note_id";
                    $fetch_result = mysqli_query($con, $fetch_details) or die(mysqli_error($con));
                    $total_num_rows = mysqli_num_rows($fetch_result);
                    if($total_num_rows>0){
                        for($i=1;$i<=$total_num_rows;$i++){
                            $row_detail = mysqli_fetch_row($fetch_result);
                            $amount = $row_detail[5];
                            $name = $row_detail[2];
                            $date = $row_detail[4];
                            $bill = $row_detail[6];
                            $heading = $row_detail[3];
                ?>
                <!--expenses panel-->
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <!--panel heading-->
                                    <div class="panel-heading" id="heading-style">
                                        <center>
                                            <p><?php echo $heading;?></p>
                                        </center>
                                    </div>
                                    <div class="panel-body">
                                        <p><b><span style='float:left;'>Amount</span><span style='float:right'> &#8377 <?php echo $amount;?></span></b></p><br>
                                        <p><b><span style='float:left;'></span>Paid by<span style='float:right'><?php echo $name?></span></b></p>
                                        <p><b><span style='float:left;'>Paid On</span><span style='float:right'><?php echo $date;?></span></b></p><br><br>
                                        <!--bill status-->
                                        <center>
                                        <?php 
                                            if($bill==NULL)
                                                echo "<a href=#>You don't have bill</a>";
                                            else{
                                                echo "<a href=$bill>Show Bill</a>";
                                            }
                                        ?>
                                        </center>
                                    </div>
                                </div>
                            </div>
                
                <?php
                        }
                    }
                ?>
                
            </div>
            
            <div class="col-sm-6" style="margin-top: 150px;padding-left: 200px;">
               
                <!--__________expense distribution button____________________-->
            <?php echo "<a href='expense-distribution.php?note_id=$note_id'>"
                    . "<button class='button1 exp-button'>Expense Distribution</button></a>";?>
                <footer>
    <!--add new expense FORM-->
                <div class="panel panel-default" style="margin-top: 125px;position: fixed;bottom:10px;">
                    <div class="panel-heading" id="heading-style" style="padding-top:10px; padding-bottom: 10px;" >
                        <center>
                            Add New Expense
                        </center>
                    </div>
                    <div class="panel-body">
                        <?php echo
                        "<form method='POST' action='view-script.php?note_id=$note_id' enctype='multipart/form-data'";?>
        <!--Expense Name-->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Expense Name" required="true"> 
                            </div>
        <!--Entering Date-->
                            <div class="form-group">
                                <label for="expense-date">Date</label>
                                <input type='date' class='form-control' name='expense-date' min=<?php echo $from;?> max=<?php echo $to;?> required='true'>
                            </div>
        <!--Entering expense-->
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" name="amount" placeholder="Amount Spent" required="true">
                            </div>
                            
        <!--____________obtaining name of all the persons____________________-->
                            <?php
                                $name_query = "SELECT * FROM budget_member WHERE nid=$note_id";
                                $name_result = mysqli_query($con, $name_query) or die(mysqli_error($con));
                                $total_num_rows = mysqli_num_rows($name_result);
                            ?>
                            <div class="form-group">
                                <select name="member_name" class="form-control">
                                    <option value="Choose Name">Choose Name</option>
                                    <?php
                                        for($i=1;$i<=$total_num_rows;$i++){
                                            $row_name = mysqli_fetch_row($name_result);
                                            $name = $row_name[2];
                                            echo "<option value='$name'>$name</option>";
                                        }
                                    ?>

                                </select>
                            </div>
                            
        <!--uploading bill-->
                            <div class="form-group">
                                <label for="bill">Upload Bill</label>
                                <input type="file" class="form-control" name="bill">
                            </div>
                            <button type="submit" class='button1'>Add</button>
                        </form>
                    </div>
                    <?php
                        if(isset($_GET['msg']))
                        {
                            $msg = $_GET['msg'];
                            echo  "<script>alert('$msg')</script>";
                        }
                    ?>
                </div></footer>
            </div>
            
        </div>
    </div>
                            
    <div class="row" style="height: 30px; width: 100%;"></div>
    <!--*********************************Footer******************************-->
    <?php
        include 'includes/footer.php';
    ?>
    </body>
</html>