<?php

            require "--config.php";

            function secure($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return($data);
            }

            $fullname = $contact = $birthday = $address = $username = "";

            $firstname = secure(mysqli_real_escape_string($link, $_POST["firstname"]));
            $lastname = secure(mysqli_real_escape_string($link, $_POST["lastname"]));
            $fullname .= $firstname." ".$lastname;

            $password = secure(mysqli_real_escape_string($link, $_POST["password"]));
            $email = secure(mysqli_real_escape_string($link, $_POST["email"]));
            $temp_contact = secure(mysqli_real_escape_string($link, $_POST["contact"]));
            $contact .= "".$temp_contact;
            $month = secure(mysqli_real_escape_string($link, $_POST["month"]));
            $day = secure(mysqli_real_escape_string($link, $_POST["day"]));
            $year = secure(mysqli_real_escape_string($link, $_POST["year"]));
            $birthday .= $year."-".$month."-".$day;
            $house = secure(mysqli_real_escape_string($link, $_POST["house"]));
            $street = secure(mysqli_real_escape_string($link, $_POST["street"]));
            $barangay = secure(mysqli_real_escape_string($link, $_POST["barangay"]));
            $city = secure(mysqli_real_escape_string($link, $_POST["city"]));
            $province = secure(mysqli_real_escape_string($link, $_POST["province"]));
            $address .= $house." ".$street.", Brgy. ".$barangay.", ".$city.", ".$province;
            $userlevel = secure(mysqli_real_escape_string($link, $_POST["userlevel"]));
            $status = secure(mysqli_real_escape_string($link, $_POST["status"]));

            $temp_username = secure(mysqli_real_escape_string($link, $_POST["username"]));
            $username .= "".$temp_username;

            echo $firstname." ".$lastname." ".$fullname." ".$username." ".$password." ".$contact." ".$email." ".$month." ".$day." ".$year." ".$birthday." ".$house." ".$street." ".$barangay." ".$city." ".$province." ".$address." ".$userlevel." ".$status;

                    if(!empty($username) && !empty($password) && !empty($fullname) && !empty($address) ){

                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $id = $_GET['id'];
                    $sql = "UPDATE accounts SET firstname='$firstname', lastname='$lastname', fullname='$fullname', username='$username', password='$password', email='$email', contact='$contact', birthmonth='$month', birthday='$day', birthyear='$year', birthdate='$birthday', house='$house', street='$street', barangay='$barangay', city='$city', province='$province', address='$address', userlevel='$userlevel', status='$status'  WHERE id = '$id' ";

                    if($query = mysqli_query($link, $sql)){
                        header("location: accounts.php?edited");
                    }
                }
                // // }
?>
