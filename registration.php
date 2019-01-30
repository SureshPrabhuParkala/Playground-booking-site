<?php  
    include_once('dbfunction.php');  
       
    $funObj = new dbfunction();  
    if($_POST['register'])
    {  
        $username = $_POST['Username'];  
        $emailid = $_POST['email'];  
        $password = $_POST['password'];  
        $phoneno = $_POST['phone'];
        $emaill = $funObj->isUserExist($emailid);  
        if(!$emaill)
        {  
            $register = $funObj->UserRegister($username, $emailid, $password, $phoneno);  
            if($register)
            {  
                echo "<script>alert('Registration Successful')</script>";  
            }
            else
            {  
                echo "<script>alert('Registration Not Successful')</script>";  
            }
        }
        else
        {
            echo "<script>alert('Email Already Exist')</script>";
        }
        else
        {
            echo "<script>alert('Password Not Match')</script>";
        }
    }
?>