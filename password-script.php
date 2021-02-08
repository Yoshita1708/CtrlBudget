<?php
    require 'includes/common.php';
    if(!isset($_SESSION['email']))
    {
        header('location: login.php');
    }
    //Fetching data
    $user_id = mysqli_real_escape_string($con, $_SESSION['user_id']);
    $old_password = md5(mysqli_real_escape_string($con,$_POST['old_password']));
    $new = $_POST['new_password'];
    $new_password = md5(mysqli_real_escape_string($con,$new ));
    $len = strlen($new);
    
    $retype_new_password = md5(mysqli_real_escape_string($con, $_POST['retype_new_password']));
    
    //Searching member
    $select_query = "SELECT id FROM users WHERE password='$old_password' and id='$user_id'";
    $select_query_result = mysqli_query($con, $select_query);
    $total_num_rows = mysqli_num_rows($select_query_result);
    
    //Password length is short
    if ($len < 6) {
      header('location: change-password.php?msg=Minimum password length is 6 ');
    }
    //Incorrect password
    else if($total_num_rows == 0)
    {
        header('location: change-password.php?msg=Old Password is incorrect!');
    }
    else {
        if($new_password === $retype_new_password)
        {
            //Updating  data
            $update_query = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
            $update_name_result = mysqli_query($con, $update_query) or die(mysqli_error($con));
            header('location: home.php?msg=Password Updated');
        }
        else {
            header('location: change-password.php?msg=Password does not match!');
        }
    }

?>

