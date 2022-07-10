<?php
 session_start();
 include "../config/connect.php";
 if(isset($_POST['btnSave']))
 {
    $email=$_SESSION['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $datebirth=$_POST['datebirth'];
    $select= "select * from usertable where email='$email'";
    $sql = mysqli_query($con,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['email'];
    if($res === $email)
    {
   
       $update = "update usertable set phone='$phone',address='$address', datebirth='$datebirth' where email='$email'";
       $sql2=mysqli_query($con,$update);
if($sql2)
       { 
           /*Successful*/
        //    header('location: profile.php');
           echo "Saved Changes";
       }
       else
       {
           /*sorry your profile is not update*/
        //    header('location:Profile_edit_form.php');
        echo "something wrong";
       }
    }
    else
    {
        /*sorry your id is not match*/
        // header('location:Profile_edit_form.php');
        echo "ID not match";
    }
 }
?>