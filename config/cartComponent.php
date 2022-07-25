<?php 


//FOR HOME PRODUCT LIST CUSTOMER
function component($productname, $productprice, $productimage, $productid){

      $element = "
      <form action='../pages/home.php' method='post'>
      <div class='card' >
      <img src='$productimage' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'><b>₱$productprice</b></h5>
        <p class='card-text'>$productname</p>

        <button type= 'submit' class='btn btn-primary' name='add'>Add to cart</button>
      </div>
    </div>
    <input type = 'hidden' name = 'productid' value = '$productid'>
      </form>
      ";

      echo $element;
}



//ADD TO CART PAGE FOR CUSTOMER
function cartElement($productname, $productprice, $productimage, $productid){

  $element = "
  <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
  <div class=\"border rounded\">
      <div class=\"row bg-white\">
          <div class=\"col-md-3 pl-0\">
              <img src=$productimage alt=\"Image1\" class=\"img-fluid\">
          </div>
          <div class=\"col-md-6\">
              <h5 class=\"pt-2\">$productname</h5>
              <small class=\"text-secondary\">Seller: dailytuition</small>
              <h5 class=\"pt-2\">$$productprice</h5>
              <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
              <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
          </div>
          <div class=\"col-md-3 py-5\">
              <div>
                  <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                  <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                  <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
              </div>
          </div>
      </div>
  </div>
</form>
  ";

  echo  $element;
}

?>