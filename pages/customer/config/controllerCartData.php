<?php 
//   include "../config/connect.php";
class productlist{
        // get product from the database
        public function getData(){
            include "../config/connect.php";
          $sql = "SELECT * FROM productlist";
    
          $result = mysqli_query($con, $sql);
    
          if(mysqli_num_rows($result) > 0){
              return $result;
          }
      }
}
?>