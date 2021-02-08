<?php
    require 'includes/common.php';
    $note_id = $_GET['note_id'];
    $title = mysqli_real_escape_string($con,$_POST['title']);
    $spend_date = mysqli_real_escape_string($con, $_POST['expense-date']);
    $amount = mysqli_real_escape_string($con,$_POST['amount']);
    $person = $_POST["member_name"];
//    $person_query = "SELECT mem_id FROM budget_member WHERE nid=$note_id and name='$person'";
//    $id_result = mysqli_query($con, $person_query) or die(mysqli_error($con));
//    $row_id = mysqli_fetch_row($id_result);
//    $mem_id = $row_id[0];

    //Uploading Image
    function GetImageExtension($imagetype){
        if(empty($imagetype)) return false;
        switch($imagetype){
            case 'image/bmp': return '.bmp';
            case 'image/gif': return '.gif';
            case 'image/jpeg': return '.jpg';
            case 'image/png': return '.png';
            default: return false;
        }
    }
    
    //Individual Expense
    function IndividualExpense($con,$note_id, $name,$amount)
    {
        $select_amount = "SELECT total_amount FROM budget_member WHERE nid='$note_id' and name='$name'";
        $amount_result = mysqli_query($con, $select_amount) or die(mysqli_error($con));
        $row_amount = mysqli_fetch_row($amount_result);
        $total_amount = $row_amount[0];
        if($total_amount==NULL)
            $total_amount=0;
        $total_amount = $total_amount + $amount;
        $update_amount = "UPDATE budget_member SET total_amount=$total_amount WHERE nid='$note_id' and name='$name'";
        $update_result = mysqli_query($con, $update_amount) or die(mysqli_error($con));
    }
    
    // Validation
    $date_fetch = "Select from_date, to_date FROM budget_index WHERE note_id=$note_id";
    $date_result = mysqli_query($con, $date_fetch) or die(mysqli_error($con));
    $row = mysqli_fetch_row($date_result);
    $from = $row[0];
    $to = $row[1];
    
    if($spend_date<$from || $spend_date>$to){
        header("Location: view-plan.php?msg=Date must lie between $from and $to & note_id=$note_id");
    echo '1';}
    else if($amount<0){
        header("Location: view-plan.php?msg=Amount should be positive. & note_id=$note_id");
        echo '2';
    }
    else if($person=="Choose Name"){
        header("Location: view-plan.php?msg=Choose one member. & note_id=$note_id");
        echo '3';
    }
    
    //Image Validation
    else if (!empty($_FILES["bill"]["name"])) {
            $file_name=$_FILES["bill"]["name"];
            $temp_name=$_FILES["bill"]["tmp_name"];
            $imgtype=$_FILES["bill"]["type"];
            $ext= GetImageExtension($imgtype);
            $imagename=date("d-m-Y")."-".time().$ext;
            $target_path = "img/".$imagename;
            
            if(move_uploaded_file($temp_name, $target_path))
            {
                
                $insert_bill_query = "INSERT INTO `member_expenditure` (`note_id`, `person`, `title`, `spend_date`, `amount`, `bill`) VALUES ('$note_id', '$person', '$title', '$spend_date', '$amount', '$target_path')";
                $insert_bill_result = mysqli_query($con, $insert_bill_query) or die(mysqli_error($con));
                IndividualExpense($con, $note_id, $person,$amount);
                header("Location: view-plan.php?note_id=$note_id");
            
        }
    }
    else{
        $insert_query = "INSERT INTO `member_expenditure` (`note_id`, `person`, `title`, `spend_date`, `amount`) VALUES ('$note_id', '$person', '$title', '$spend_date','$amount')";
        $insert_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));
        IndividualExpense($con, $note_id, $person,$amount);
        header("Location: view-plan.php?note_id=$note_id");
    }

    
    
    
    
?>

