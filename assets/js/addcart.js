$(document).ready(function() {

  // Send product details in the server
  $(".addItemBtn").click(function(e) {
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var id = $form.find(".id").val();
    var product = $form.find(".product").val();
    var price = $form.find(".price").val();
    var image_file = $form.find(".image_file").val();
    var serialnumber = $form.find(".serialnumber").val();

    var quantity = $form.find(".quantity").val();

    $.ajax({
      url: '/pages/customer/config/--action.php',
      method: 'post',
      data: {
        id: id,
        product: product,
        price: price,
        quantity: quantity,
        image_file: image_file,
        serialnumber: serialnumber
      },
      success: function(response) {
        $("#message").html(response);
        // window.scrollTo(0, 0);
        load_cart_item_number();
      }
    });
  });

  // Load total no.of items added in the cart and display in the navbar
  load_cart_item_number();

  function load_cart_item_number() {
    $.ajax({
      url: '/pages/customer/config/--action.php',
      method: 'get',
      data: {
        cartItem: "cart_item"
      },
      success: function(response) {
        $("#cart-item").html(response);
      }
    });
  }


    $(".btnRemove").on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href')

        Swal.fire({
        title: 'Remove from the cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Remove'
      }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
      })
    });

        // Sending Form data to the server
        $("#placeOrder").submit(function(e) {
          e.preventDefault(); 
    
          $.ajax({
            url: '/pages/customer/config/--action.php',
            method: 'post',
            data: $('form').serialize() + "&action=order",
            success: function(response) {
              $("#order").html(response);
              window.scrollTo(0, 0);
              load_cart_item_number();
            }
          });
        });

        $('#modalOrder').on('hidden.bs.modal', function () {
          location.reload();
         })
    
});


function updcart(id){
  $.ajax({
    url:'/pages/customer/updqty.php',
    type:'POST',
    data:$("#frm"+id).serialize(),
    success:function(res){
      location.reload(true);
      // $("#cartcart").html(res);
    }
  });
  
  }