<?php    
    class dbfunction 
    {  
        protected $con;
        public function __construct()
        {
            $servername="localhost";  
            $username="root";  
            $password="root";  
            $dbname="intern_project"; 
            $this->con =mysqli_connect($servername, $username, $password, $dbname);  
            if($this->con)
            {
                return $this->con;    
            }
        }

        public function UserRegister($username, $emailid, $password, $phoneno)
        {  
                $q="INSERT INTO `user_reg` (`user_id`, `user_name`, `email`, `password`, `phone_number`) VALUES (NULL, '$username', '$emailid', '$password', '$phoneno');";  
                $result=mysqli_query($this->con,$q);
                if(!$result)
                {
                    echo "error";
                }
                else
                {
                    header("location: login.php");
                }
        }

        public function loginValidation($username, $password)
        {
            $q="SELECT * FROM `user_reg` WHERE user_name='$username' AND password='$password'";
            $result=mysqli_query($this->con,$q);
            if(mysqli_num_rows($result)==1)
            {
                session_start();
                while($row=$result->fetch_assoc())
                {
                    $name=$row['user_name'];
                    $_SESSION['login_user']=$name;
                    $userid=$row['user_id'];
                    $_SESSION['login_id']=$userid;
                    header("location: index.php");
                }
            }
            else
            {
                echo "<script>alert('Username and Password does not match')</script>";
                header("location: login.php");
            }
        } 

        public function adminloginValidation($username, $password)
        {
            $q="SELECT * FROM `admin_login` WHERE name='$username' AND password='$password'";
            $result=mysqli_query($this->con,$q);
            if(mysqli_num_rows($result)==1)
            {
                session_start();
                while($row=$result->fetch_assoc())
                {
                    $id=$row['id'];
                    $_SESSION['admin_id']=$id;
                    header('location: addsport.php');
                }
            }
            else
            {
                echo "<script>alert('Username and Password does not match')</script>";
                header("location: login.php");
            }
        }

        public function index()
        {
            $q="SELECT * FROM sports";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function uploadsport($name, $details, $filename)
        {
            $location = 'images/'.$filename;

            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            $image_ext = array("jpg","png","jpeg","gif");
            $q="INSERT INTO `sports` (`sports_name`, `sports_description`, `sports_image`) VALUES ('$name', '$details', '".$location."')";

            if(mysqli_query($this->con,$q))
                echo "<script>alert('Success')</script>";

            if(in_array($file_extension,$image_ext))
            {
                if(!move_uploaded_file($_FILES['file']['tmp_name'],$location))
                {
                    echo "<script>alert('Image is not uploaded to folder')</script>";
                }
            }
        }

        public function uploadvenue($placename, $venuename, $details, $price, $maxplayers, $sport, $filename)
        {
            $q1="SELECT sports_id FROM sports WHERE sports_name='$sport'";
            $result=mysqli_query($this->con,$q1);
            $row=$result->fetch_assoc();

            $location = 'images/'.$filename;

            $file_extension = pathinfo($location,PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            $image_ext = array("jpg","png","jpeg","gif");

            $q2="INSERT INTO `venue` (`venue_id`, `place`, `venue_name`, `venue_image`, `venue_description`, `sports_id`, `price`, `maximum_players`) VALUES (NULL, '$placename', '$venuename', '".$location."', '$details', '".$row['sports_id']."', '$price', '$maxplayers ')";

            if(mysqli_query($this->con,$q2))
                echo "<script>alert('Success')</script>";

            if(in_array($file_extension,$image_ext))
            {
                if(!move_uploaded_file($_FILES['file']['tmp_name'],$location))
                {
                    echo "<Script>alert('Image is not uploaded to folder')</script>";
                }
            }
        }

        public function sportnamedropdown()
        {
            $q="SELECT sports_name FROM sports";
            $result=mysqli_query($this->con,$q);
            return $result;
        }

        public function Sports($id)
        {
            $q="SELECT * FROM sports WHERE sports_id='$id'";
            $result=mysqli_query($this->con,$q);
            return $result;
        }

        public function placedropdown($id)
        {
            $q1="SELECT DISTINCT place FROM venue WHERE sports_id='$id';";
            $result=mysqli_query($this->con,$q1);
            return $result;
        }

        // public function venueview($venuename, $spid, $con)
        // {
        //     $q="SELECT venue_id from venue WHERE venue_name='$venuename' AND sports_id='$spid'";
        //     $result=mysqli_query($con,$q);
        //     while($row=$result->fetch_assoc())
        //     {
        //         header('location: venueview.php?id='.$row['venue_id'].'');
        //     }
        // }

        public function list_of_venue($venueplace, $id)
        {
            $q="SELECT venue_name, price, venue_id FROM venue WHERE place='$venueplace' AND sports_id='$id'";
            return mysqli_query($this->con,$q);
        }

        public function Booking($loginid, $loginuser, $sportsid, $venueid, $date, $session, $team, $number)
        {
            $query="SELECT maximum_players FROM venue WHERE venue_id='$venueid'";
            $resq=mysqli_query($this->con, $query);
            $resqrow=$resq->fetch_assoc();
            $max=$resqrow['maximum_players']/2;
            $q="SELECT * FROM booked WHERE user_id='$loginid' AND venue_id='$venueid' AND datee='$date' AND timee='$session'";
            $res=mysqli_query($this->con, $q);
            if(mysqli_num_rows($res)>0)
            {
                while($row=$res->fetch_assoc())
                {
                    $q="SELECT * FROM booked WHERE datee='$date' AND timee='$session'";
                    $teama=$row['team_a'];
                    $teamb=$row['team_b'];
                    $res1=mysqli_query($this->con, $q);
                    if($res1)
                    {
                        if($team == "TeamA")
                        {
                            if($teama>0)
                                $teama=$teama+$number;
                            else
                                $teama=$number;
                            if($teama<=$max)
                            {
                                $q2="UPDATE booked SET team_a=$teama WHERE user_id='$loginid' AND datee='$date' AND timee='$session'";
                                $res2=mysqli_query($this->con, $q2);
                                if($res2)
                                    header('location: done.php?t='.$team.'&num='.$number.'&sport='.$sportsid.'&venue='.$venueid.'&time='.$session.'&date='.$date);
                            }
                            else
                                echo "<script>alert('$number Seats are not Available in Team A');</script>";
                        }
                        elseif($team == "TeamB")
                        {
                            if($teamb>0)
                                $teamb=$teamb+$number;
                            else
                                $teamb=$number;
                            if($teamb<=$max)
                            {
                                $q3="UPDATE booked SET team_b=$teamb WHERE user_id='$loginid' AND datee='$date' AND
                                    timee='$session'";
                                $res3=mysqli_query($this->con, $q3);
                                if($res3)
                                    header('location: done.php?t='.$team.'&num='.$number.'&sport='.$sportsid.'&venue='.$venueid.'&time='.$session.'&date='.$date);
                            }
                            else
                                echo "<script>alert('$number Seats are not Available in Team B');</script>";
                        }    
                    }
                }
            }
            else
            {
                if($team == "TeamA")
                {
                    if($number<=$max)
                    {
                        $q4="INSERT INTO `booked` (`user_id`, `user_name`, `sports_id`, `venue_id`, `datee`, `timee`, `team_a`) VALUES ('$loginid', '$loginuser', '$sportsid', '$venueid', '$date', '$session', '$number');";
                        $result=mysqli_query($this->con, $q4);
                        if($result)
                            header('location: done.php?t='.$team.'&num='.$number.'&sport='.$sportsid.'&venue='.$venueid.'&time='.$session.'&date='.$date);
                    }
                    else
                        echo "<script>alert('$number Seats are not Available in Team A');</script>";
                }
                elseif($team == "TeamB")
                {
                    if($number<=$max)
                    {
                        $q5="INSERT INTO `booked` (`user_id`, `user_name`, `sports_id`, `venue_id`, `datee`, `timee`, `team_b`) VALUES ('$loginid', '$loginuser', '$sportsid', '$venueid', '$date', '$session', '$number');";
                        $result=mysqli_query($this->con, $q5);  
                        if($result)
                            header('location: done.php?t='.$team.'&num='.$number.'&sport='.$sportsid.'&venue='.$venueid.'&time='.$session.'&date='.$date);
                    }
                    else
                        echo "<script>alert('$number Seats are not Available in /team B');</script>";
                }
                else
                    echo "<script>alert('Error')</script>";
            }
        }

        public function venue($id)
        {
            $q="SELECT * FROM venue WHERE venue_id='$id'";
            $result=mysqli_query($this->con,$q);
            return $result;
        }

        public function BookingDisplay($loginuser)
        {
            $q="SELECT * FROM booked WHERE user_name='$loginuser'";
            $result=mysqli_query($this->con,$q);  
            return $result;
        }

        public function FetchVenueTable($venueid)
        {
            $q="SELECT * FROM venue WHERE venue_id='$venueid'";
            $result=mysqli_query($this->con,$q);
            return $result;
        }

        public function FetchSportName($sportsid)
        {
            $q="SELECT * FROM sports WHERE sports_id='$sportsid'";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function calc($vid)
        {
            $q="SELECT * FROM venue WHERE venue_id='$vid'";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function getremainingseatA($date, $time, $vid)
        {
            $q="SELECT SUM(team_a) FROM booked WHERE datee='$date' AND timee='$time' AND venue_id=$vid";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function getremainingseatB($date, $time, $vid)
        {
            $q="SELECT SUM(team_b) FROM booked WHERE datee='$date' AND timee='$time' AND venue_id=$vid";
            $result=mysqli_query($this->con, $q);
            return $result;
        }        

        public function getmaxplayers($vid)
        {
            $q="SELECT maximum_players FROM venue WHERE venue_id=$vid";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function bookedtable()
        {
            $q="SELECT * FROM booked";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function usertable()
        {
            $q="SELECT * FROM user_reg";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function venuetable()
        {
            $q="SELECT * FROM venue";
            $result=mysqli_query($this->con, $q);
            return $result;
        }

        public function admintable()
        {
            $q="SELECT * FROM admin_login";
            $result=mysqli_query($this->con, $q);
            return $result;
        }
    }
?>