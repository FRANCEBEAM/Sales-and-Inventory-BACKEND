<?php

    require "--config.php";
    

            function secure($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return($data);
            }

            $firstname = secure(mysqli_real_escape_string($link, $_POST["firstname"]));
            $lastname = secure(mysqli_real_escape_string($link, $_POST["lastname"]));
            $fullname .= $firstname." ".$lastname;

            $password = secure(mysqli_real_escape_string($link, $_POST["password"]));
            $email = secure(mysqli_real_escape_string($link, $_POST["email"]));
            $temp_contact = secure(mysqli_real_escape_string($link, $_POST["contact"]));
            $contact .= "0".$temp_contact;
            $month = secure(mysqli_real_escape_string($link, $_POST["month"]));
            $day = secure(mysqli_real_escape_string($link, $_POST["day"]));
            $year = secure(mysqli_real_escape_string($link, $_POST["year"]));
            $birthday .= $year."-".$month."-".$day;
            $house = secure(mysqli_real_escape_string($link, $_POST["house"]));
            $street = secure(mysqli_real_escape_string($link, $_POST["street"]));
            $barangay = secure(mysqli_real_escape_string($link, $_POST["barangay"]));
            $city = secure(mysqli_real_escape_string($link, $_POST["city"]));
            $province = secure(mysqli_real_escape_string($link, $_POST["province"]));
            $address .= $house." ".$street." St., Brgy. ".$barangay.", ".$city.", ".$province;
            $userlevel = secure(mysqli_real_escape_string($link, $_POST["userlevel"]));

            $username = secure(mysqli_real_escape_string($link, $_POST["username"]));

                if(!empty(trim($firstname) && !empty(trim($lastname)) && !empty(trim($fullname)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($email)) && !empty(trim($contact)) && !empty(trim($month)) && !empty(trim($day)) && !empty(trim($year)) && !empty(trim($birthday)) && !empty(trim($house)) && !empty(trim($street)) && !empty(trim($barangay)) && !empty(trim($city)) && !empty(trim($province)) && !empty(trim($address)) && !empty(trim($userlevel)) )){

                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO accounts (firstname, lastname, fullname, username, password, email, contact, birthmonth, birthday, birthyear, birthdate, house, street, barangay, city, province, address, userlevel) VALUES ('$firstname', '$lastname', '$fullname', '$username', '$password', '$email', '$contact', '$month', '$day', '$year', '$birthday', '$house', '$street', '$barangay', '$city', '$province', '$address', '$userlevel')";

                    if($query = mysqli_query($link, $sql)){
                        header("location: accounts.php?created");
                    }
                    
                        
                    

                }
?>