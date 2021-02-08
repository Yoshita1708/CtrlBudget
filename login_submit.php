<?php
    require 'includes/common.php';
    
    //Fetching data
    
    $email =  mysqli_real_escape_string($con,$_POST['email']); 
    $password =  md5(mysqli_real_escape_string($con,$_POST['password']));
    
    $email_fetch = "SELECT id, email FROM users WHERE email='$email'";
    $email_result = mysqli_query($con, $email_fetch) or die(mysqli_error($con));
    $total_num_rows_fetched = mysqli_num_rows($email_result);
    
    if($total_num_rows_fetched == 0)//No such email exist
    {
        header('Location: login.php?msg=Invalid email');
    }
    else{ //email exist
        $info_fetch = "SELECT id, email FROM users WHERE email='$email' and password='$password'";
        $fetch_result = mysqli_query($con, $info_fetch) or die(mysqli_error($con));
        $total_rows_fetched = mysqli_num_rows($fetch_result);

        if($total_rows_fetched == 0)//wrong password
        {
            header('Location: login.php?msg=Invalid password');
        }
        else {//correct password
            $row = mysqli_fetch_array($fetch_result);
            $_SESSION['email'] = $row[1];
            $_SESSION['user_id'] = $row[0];
            
            header('location: home.php');
        }
    }
?>
