<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
        header ("Location: login.php");
    $note_id = $_GET['note_id'];
    
    //Total Expenditure
    function totalAmount($con,$note_id)
    {
        $select_query = "SELECT amount FROM member_expenditure WHERE note_id='$note_id'";
        $select_result = mysqli_query($con, $select_query) or die(mysqli_error($con));

        $total_num_rows = mysqli_num_rows($select_result);
        $sum = 0;
        for($i=1;$i<=$total_num_rows;$i++){
            $row_amount = mysqli_fetch_row($select_result);

            $amount = $row_amount[0];
            $sum = $sum + $amount;
        }
        
        return $sum;
    }
    
    
    
    
    
?>

<!--*******************Creating Layout For The Page**************************-->
<!DOCTYPE html>
<html>
    <head>
        <title>Expense Distribution</title>
        
        <style>
            
            .button1 {
                
                
                padding: 6px 20px;
                text-align: center;
                text-decoration: none;
                
                font-size: 14px;
                margin: 2px 2px;
                transition-duration: 0.4s;
                cursor: pointer;
                border-radius: 4px;
                width: 30%;;
                
                background-color: white; 
                color: #4D774F; 
                border: 2px solid #4D774F;

              }
              
              .button1:hover {
                background-color: #4D774F;
                color: white;
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
    <body id="background_clr">
    <!--*****************************Header**********************************-->
        <?php
            include 'includes/header.php';
        ?>
    <!--*****************************Content*********************************-->
        <div class="row">
            <div class="container-fluid">
                <div class="col-xs-4"></div>
        <!--****************************Panel********************************-->
                <div class="col-xs-4">
                    <div class="panel panel-default" style="width: 100%;margin-top:150px">
                        <div class="panel-heading" style="background-color:#4D774F;color:#ffffff;width: 100%;padding-top: 15px">
                            <?php
                            $select_detail = "SELECT initial_budget, title, no_of_people FROM budget_index WHERE note_id=$note_id";
                            $title_result = mysqli_query($con, $select_detail) or die(mysqli_error($con));
                            $row_title = mysqli_fetch_row($title_result);
                            $title = $row_title[1];
                            $initial_budget = $row_title[0];             
                            $no_of_people = $row_title[2];
                            ?>
                            <center>
                                <p><?php echo $title;?><span class="glyphicon glyphicon-user" style="float: right;"><?php echo " $no_of_people"?></span></p>
                            </center>
                        </div>
                        <div class="panel-body">
                        <!--title-->
                            <p><b><span style="float:left;">Initial Budget</span><span style="float: right;">&#8377 <?php echo $initial_budget;?></span></b></p><br>
                            <!--Individual expense-->
                            <?php
                                $select_person = "SELECT name, total_amount FROM budget_member WHERE nid=$note_id";
                                $person_result = mysqli_query($con, $select_person) or die(mysqli_error($con));
                                $total_num_rows = mysqli_num_rows($person_result);
                                for($i=1;$i<=$total_num_rows;$i++)
                                {
                                    $row = mysqli_fetch_row($person_result);
                                    $name = $row[0];
                                    $amount = $row[1];
                                    if($amount==NULL)
                                        $amount=0;
                                    echo "<p><b><span style='float:left;'>$name</span></b><span style='float: right;'>";?>&#8377 <?php echo "$amount</span></p><br>";
                                }
                            ?>
                        <!--total amount spent-->
                            <?php
                                 $total_expense = totalAmount($con, $note_id);
                                 echo "<p><b><span style='float:left;'>Total Amount Spent</span><span style='float: right;'>";?>&#8377 <?php echo "$total_expense</span></b></p><br>";
                            ?>
                        <!--Remaining amount-->
                             <?php
                                $remaining_amount = $initial_budget - $total_expense;
                                if($remaining_amount>0)
                                {   echo "<p><b><span style='float:left;'>Remaining Amount</span>"
                                    . "<span style='float: right;color:#33ae33'>";?>&#8377 <?php echo round($remaining_amount)."</span></b></p><br>";
                                }
                                else if($remaining_amount==0)
                                {
                                    echo "<p><b><span style='float:left;'>Remaining Amount</span>"
                                    . "<span style='float: right;color:#000000'>";?>&#8377 <?php echo "$remaining_amount</span></b></p><br>";
                                }
                                else
                                {
                                    echo "<p><b><span style='float:left;'>Remaining Amount</span>"
                                    . "<span style='float: right;color:#f15404'>";?> Overspent by &#8377 <?php echo abs($remaining_amount)."</span></b></p><br>";
                                }
                                
                            ?>
                        <!--Individual Share-->
                             <?php
                                $individual = $total_expense/$total_num_rows;
                                
                                echo "<p><b><span style='float:left;'>Individual Share</span>"
                                . "<span style='float: right;'>";?>&#8377 <?php echo round($individual)."</span></b></p><br>";
                             ?>
                        <!--Individual share name wise-->
                            <?php
                                $select_person = "SELECT name, total_amount FROM budget_member WHERE nid=$note_id";
                                $person_result = mysqli_query($con, $select_person) or die(mysqli_error($con));
                                $total_num_rows = mysqli_num_rows($person_result);
                                for($i=1;$i<=$total_num_rows;$i++)
                                {
                                    $row = mysqli_fetch_row($person_result);
                                    $name = $row[0];
                                    $amount = $row[1];
                                    $my_share = $amount - $individual;
                                    if($my_share>0)
                                    {
                                        echo "<p><b><span style='float:left;'>$name</span></b>"
                                            . "<span style='float: right;color:#33ae33'>";?>Gets back &#8377 <?php echo round($my_share)."</span></p><br>";
                                    }
                                    else if($my_share==0)
                                    {
                                        echo "<p><b><span style='float:left;'>$name</span></b>"
                                            . "<span style='float: right;'>All Settled Up</span></p><br>";
                                    }
                                    else
                                    {
                                        echo "<p><b><span style='float:left;'>$name</span></b>"
                                            . "<span style='float: right;color:#f15404'>";?>Owes &#8377 <?php echo round(abs($my_share))."</span></p><br>";
                                    }
                                }
                            ?>
                        <!--Go back button-->
                            <center>
                            <?php echo "<a href='view-plan.php?note_id=$note_id'>"
                            . "<button class='button1 exp-button '><span class='glyphicon glyphicon-arrow-left'></span> Go Back</button></a>";?>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <!--*****************************Footer**********************************-->
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>