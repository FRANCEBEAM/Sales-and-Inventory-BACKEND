<?php 

require "../config/connect.php";


class productList{
        // get product from the database
        public function getData(){
          require "../config/connect.php";
          $sql = "SELECT * FROM productlist";
    
          $result = mysqli_query($con, $sql);
    
          if(mysqli_num_rows($result) > 0){
              return $result;
          }
      }
}
?>