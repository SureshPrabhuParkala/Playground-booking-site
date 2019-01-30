<?php    
    class dbfunction 
    {  
        public function connection()
        {
            $servername="localhost";  
            $username="root";  
            $password="root";  
            $dbname="intern_project"; 
            $con =mysqli_connect($servername, $username, $password, $dbname);  
            if($con)
            {
                return $con;    
            }
        }

        public function UserRegister($username, $emailid, $password, $phoneno, $con)
        {  
                $q="INSERT INTO `user_reg` (`user_id`, `user_name`, `email`, `password`, `phone_number`) VALUES (NULL, '$username', '$emailid', '$password', '$phoneno');";  
                $result=mysqli_query($con,$q);
                if(!$result)
                {
                    echo "error";
                }
                else
                {
                    header("location: login.php");
                }
        }

        public function loginValidation($username, $password, $con)
        {
            $q="SELECT * FROM `user_reg` WHERE user_name='$username' AND password='$password'";
            $result=mysqli_query($con,$q);
            $count=mysqli_num_rows($result);
            if($count==1)
            {
                header("location: index.html");
            }
            else
            {
                echo "incorrect username or password";
            }
        } 

        public function adminloginValidation($username, $password, $con)
        {
            $q="SELECT * FROM `admin_login` WHERE name='$username' AND password='$password'";
            $result=mysqli_query($con,$q);
            $count=mysqli_num_rows($result);
            if($count==1)
            {
                header("location: addsport.php");
            }
            else
            {
                echo "incorrect username or password";
            }
        }

        public function uploadsport($name, $details, $filename, $con)
        {
            $location = 'images/'.$filename;

            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            $image_ext = array("jpg","png","jpeg","gif");
            $q="INSERT INTO `sports` (`sports_name`, `sports_description`, `sports_image`) VALUES ('$name', '$details', '".$location."')";

            if(mysqli_query($con,$q))
                echo "<script>alert('Success')</script>";

            if(in_array($file_extension,$image_ext))
            {
                if(!move_uploaded_file($_FILES['file']['tmp_name'],$location))
                {
                    echo "<script>alert('Image is not uploaded to folder')</script>";
                }
            }
        }

        public function uploadvenue($placename, $venuename, $details, $price, $maxplayers, $sport, $filename, $con)
        {
            $q1="SELECT sports_id FROM sports WHERE sports_name='$sport'";
            $result=mysqli_query($con,$q1);
            $row=$result->fetch_assoc();

            $location = 'images/'.$filename;

            $file_extension = pathinfo($location,PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            $image_ext = array("jpg","png","jpeg","gif");

            $q2="INSERT INTO `venue` (`venue_id`, `place`, `venue_name`, `venue_image`, `venue_description`, `sports_id`, `price`, `maximum_players`) VALUES (NULL, '$placename', '$venuename', '".$location."', '$details', '".$row['sports_id']."', '$price', '$maxplayers ')";

            if(mysqli_query($con,$q2))
                echo "<script>alert('Success')</script>";

            if(in_array($file_extension,$image_ext))
            {
                if(!move_uploaded_file($_FILES['file']['tmp_name'],$location))
                {
                    echo "<Script>alert('Image is not uploaded to folder')</script>";
                }
            }
        }

        public function venueview($venuename, $con)
        {
            $q="SELECT venue_id from venue WHERE venue_name='$venuename'";
            $result=mysqli_query($con,$q);
            while($row=$result->fetch_assoc())
            {
                header('location: venueview.php?id='.$row['venue_id'].'');
            }
        }
    }
?>