<?php
    require 'includes/common.php';
    $user_id = $_SESSION['user_id'];
    $note_id = $_SESSION['note_id'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $from = mysqli_real_escape_string($con, $_POST['from']);
    $to = mysqli_real_escape_string($con, $_POST['to']);
    
    //validation of dates
    if($to<=$from){
        header("Location: plan-details.php?msg=Starting date should be before the Ending date!");
    }
    
//Fetching names for number of person
    else{
    $select_query = "SELECT no_of_people from budget_index WHERE note_id = $note_id";
    $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
    $rows = mysqli_fetch_array($select_query_result);
    $no_of_people = $rows[0];
 
    for($i=1;$i<=$no_of_people;$i++)
    {
        $person[$i] = mysqli_real_escape_string($con, $_POST["person$i"]);
       
    }
    
    //Inserting data in budget_index table
    $insert_info = "UPDATE budget_index SET title='$title', from_date='$from',to_date='$to' WHERE note_id=$note_id";
    $insert_info_result = mysqli_query($con, $insert_info) or die(mysqli_error($con));
    
    //Inserting data in budget_member table
    for($i=1;$i<=$no_of_people;$i++)
    {
        $insert_person = "INSERT INTO budget_member(nid, name) VALUES('$note_id','$person[$i]')";
        $insert_person_result = mysqli_query($con, $insert_person) or die(mysqli_error($con));
    }
    header("Location: home.php?msg=Your New Budget PlannerAdded Successfully");
    }
?>

