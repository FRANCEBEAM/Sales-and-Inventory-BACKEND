<?php 
   require "../config/connect.php";

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
function cartElement($productimage, $productname, $productprice, $productid){

  $element = "

  <form action='../pages/cart.php?action=remove&id=$productid' method='post' class='cart-items'>
    <table class='table'>
        <tbody class='mt-2'>
            <tr class='item mt-2'>
              <td>
              <img src='$productimage' class='card-img-top' alt='...'>
                <p>$productname</p>
              </td>
      
              <td>
                <div class='qty-container'>
                <button type='button'>-</button>
                <input type='text' style='width: 30px;' value= '1'>
                <button type='button'>+</button>
              </div>
              </td>
              <td class='price'>$productprice</td>
              <td><button type = 'submit' name = 'remove'><i class='bi bi-trash3'></i></button></td>
              </tr>
          </tbody>
      </table>
</form>
";

  echo  $element;
}
