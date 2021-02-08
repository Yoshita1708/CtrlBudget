<?php
    require 'includes/common.php';
    $user_id = $_SESSION['user_id'];
    
    $budget = $_POST['initial_budget'];
    $no_of_people = $_POST['no_of_people'];
    //amount verification
    if($budget<50){
        header('Location: create-a-new-plan.php?msg=Enter amount greater than 50.');
    }
//    number of people verfication
    else if($no_of_people<1){
        header('Location: create-a-new-plan.php?msg=There should be atleast 1 person.');
    }
    else {
        $insert_budget = "INSERT INTO budget_index(user_id, initial_budget, no_of_people ) VALUES('$user_id', '$budget', '$no_of_people')";
        $insert_result = mysqli_query($con, $insert_budget) or die(mysqli_error($con)); 
        
        $_SESSION['note_id'] = mysqli_insert_id($con);
        header('Location: plan-details.php');
    }
?>
