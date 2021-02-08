<?php
    require 'includes/common.php';
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $ph = $_POST['phone_number'];
    
    // Email Verification
    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
    
    if (!preg_match($regex_email, $email)) {
        header('Location: signup.php?msg=Invalid Email');
        //echo ("<script>location.href='signup.php?msg=Invalid Email'</script>");
    }
    //password verfication
    else if (strlen($pass) < 6) {
        header('Location: signup.php?msg=Password too short!');
    }
    //phone verification
    else if (strlen($ph) <> 10) {
        header('Location: signup.php?msg=Invalid phone number');
    }
    
    else{
        $email_id = mysqli_real_escape_string($con, $email);
        $password = md5(mysqli_real_escape_string($con, $pass));
        $phone = mysqli_real_escape_string($con, $ph);
        
        $search_query = "SELECT id FROM users WHERE email='$email_id'";
        $search_result = mysqli_query($con, $search_query) or die(mysqli_error($con));
        $total_rows_fetched = mysqli_num_rows($search_result);

        if($total_rows_fetched>0){
            header('location: signup.php?msg=Email ID Already Exist!');
        }
        else {
            $insert_query = "insert into users(name, email, password, phone)"
            . "values ('$name', '$email_id', '$password','$phone')";
            $insert_submit = mysqli_query($con, $insert_query) or die(mysqli_error($con));

            $_SESSION['user_id'] = mysqli_insert_id($con);
            $_SESSION['email'] = $email;
            header('location: home.php?msg=User successfully registered!');
        }
    }
    
?>