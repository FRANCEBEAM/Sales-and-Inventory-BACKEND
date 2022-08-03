
$(document).ready(function(){
  displayData();
});

//display function
function displayData() {
  var displayData="true";
  $.ajax({
      url:"display.php",
      type:'post',
      data:{
          displaySend:displayData
      },
      success:function(data,status){
          $('#displayDataTable').html(data);
      }
  });
}

function addproduct(){
  var itemnameAdd=$('#itemnamefield').val();
  var categoryAdd=$('#categoryfield').val();
  var unitcostAdd=$('#unitcostfield').val();
  var stockAdd=$('#stockfield').val();
  var statusAdd=$('#statusfield').val();
  var supplierAdd=$('#supplierfield').val();
  var imageAdd=$('#imagefield').val();
  var descriptionAdd=$('#descriptionfield').val();
  
  $.ajax({
      url:"insert.php",
      type:'post',
      data:{
          itemnameSend:itemnameAdd,
          categorySend:categoryAdd,
          unitcostSend:unitcostAdd, 
          stockSend:stockAdd, 
          statusSend:statusAdd,
          supplierSend:supplierAdd,
          imageSend:imageAdd,
          descriptionSend:descriptionAdd
      },
      success:function(data,status) {
          //function to display
          // console.log(status);
          $('#completeModal').modal('hide');
          load_data();
      }
  });
}

//delete record
function deleteProduct(deleteno) {
  $.ajax({
      url:"delete.php",
      type:'post',
      data:{
          deletesend:deleteno
      },
      success:function(data,status){
          load_data();
      }
  });
}

//update function
function updateProduct(updateid){
  $('#hiddendata').val(updateid);

  $.post("update.php", {updateid:updateid}, function(data,status) {
      var userid=JSON.parse(data);
      $('#updateitemnamefield').val(userid.itemname);
      $('#updatecategoryfield').val(userid.category);
      $('#updateunitcostfield').val(userid.unitcost);
      $('#updatestockfield').val(userid.stock);
      $('#updatestatusfield').val(userid.status);
      $('#updatesupplierfield').val(userid.supplier);
      $('#updateimagefield').val(userid.productimage);
      $('#updatedescriptionfield').val(userid.productdescription);
  });

  $('#updateModal').modal("show");
}

//onclick update event Details
function updateDetails(){
  var updateitemnamefield=$('#updateitemnamefield').val();
  var updatecategoryfield=$('#updatecategoryfield').val();
  var updateunitcostfield=$('#updateunitcostfield').val();
  var updatestockfield=$('#updatestockfield').val();
  var updatestatusfield=$('#updatestatusfield').val();
  var updatesupplierfield=$('#updatesupplierfield').val();
  var updateimagefield=$('#updateimagefield').val();
  var updatedescriptionfield=$('#updatedescriptionfield').val();
  var hiddendata=$('#hiddendata').val();

  $.post("update.php", {
    updateitemnamefield:updateitemnamefield,
    updatecategoryfield:updatecategoryfield,
    updateunitcostfield:updateunitcostfield,
    updatestockfield:updatestockfield,
    updatestatusfield:updatestatusfield,
    updatesupplierfield:updatesupplierfield,
    updateimagefield:updateimagefield,
    updatedescriptionfield:updatedescriptionfield,
    hiddendata:hiddendata
      },function(data,status){
      $('#updateModal').modal('hide');
      load_data();
  });
}

function load_data(query) {
  $.ajax({
      url:"search.php",
      method:"post",
      data:{query:query},
      success:function(data)
      {
          $('#result').html(data);
      }
  });
}

function sales_product_update(category) {
  $.ajax({
      url:"salesProductUpdate.php",
      method:"post",
      data:{category:category},
      success:function(data) {
          $("#products").text("");
          for(const name of JSON.parse(data)) {
              $("#products").append("<option>" + name + "</option>");
          }
      }
  });
}

//search function
$(document).ready(function(){
load_data();

$('#search_text').keyup(function() {
  var search = $(this).val();
  if(search != '') {
      load_data(search);
  }
  else {
      load_data();
  }
});
});