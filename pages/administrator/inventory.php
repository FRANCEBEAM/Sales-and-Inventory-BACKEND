<!-- Coding by RJ Avanceña Enterprises -->
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '--header.php'; ?>

    <title>Inventory</title> 

</head>
<body>

<?php include '--sidebar.php'; ?>

    <section class="home">
        <div class="text">Inventory</div>

                    <!-- TOP FUNCTION -->
            <div class="top-function">

              <!-- BUTTON FOR ADD ITEM -->
               <button type="button" class="btn btn-primary mx-5 mt-3 my-3" data-toggle="modal" data-target="#completeModal">
            Add New Product
                </button>

                     <!-- MODAL FOR ADD ITEM -->
                <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                 
                    <div class="form-group">
                    <div class="form-group">
                        <label for="nameProduct mb-3">Item name</label>
                        <input type="text" class="form-control mb-3 border" id="itemnamefield" placeholder="Name of the product">
                        </div>

                    <label for="foodCategory mb-3">Category</label>
                    <select class="form-control mb-3 border" id="categoryfield">
                        <option>Hand Tools</option>
                        <option>Welding Equipment</option>
                        <option>Paints</option>
                        <option>Cement</option>
                        <option>Woods</option>
                        <option>Cutting Tools</option>
                        <option>Power Tools</option>
                        <option>Structural Tools</option>
                        <option>Measure Tools</option>
                    </select>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="nameProduct mb-3">Unit Price ₱</label>
                        <input type="number" class="form-control mb-3 border" id="unitcostfield" >
                        </div>
                   
                    <div class="input-group mb-3"> 
                    <div class="input-stock-prepend">
                        <span class="input-group-text">Stock</span>
                    </div>
                    <input type="number" class="form-control border" id="stockfield" style="border-radius: 5px black;">
                    <select class="status-prepend" id="statusfield">
                    <option class="badge bg-success">Available</option>
                        <option class="badge bg-warning">Low</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nameProduct mb-3">Supplier Name</label>
                        <input type="text" class="form-control mb-3 border" id="supplierfield" >
                        </div>

                        
                        <div class="form-group mb-3">
                            <label for="nameProduct mb-3">Product Image</label>
                            <input type="file" class="form-control mb-3 border" id="imagefield" name="img" accept="image/*">
                            </div>
                            
                        <div class="form-group mb-3">
                            <label for="productDescription mb-3">Product Description</label>
                           <textarea name="descriptionfield" id="" cols="30" rows="5" style="resize: none;"></textarea>
                            </div>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="addproduct()">Submit</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                   
                       </div>
                    </div>
                </div>
                </div>

            <!-- update modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                 
                    <div class="form-group">
                    <div class="form-group">
                        <label for="nameProduct mb-3">Item name</label>
                        <input type="text" class="form-control mb-3 border" id="updateitemnamefield" placeholder="Name of the product">
                        </div>

                    <label for="foodCategory mb-3">Category</label>
                    <select class="form-control mb-3 border" id="updatecategoryfield">
                        <option>Hand Tools</option>
                        <option>Welding Equipment</option>
                        <option>Paints</option>
                        <option>Cement</option>
                        <option>Woods</option>
                        <option>Cutting Tools</option>
                        <option>Power Tools</option>
                        <option>Structural Tools</option>
                        <option>Measure Tools</option>
                    </select>
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="nameProduct mb-3">Unit Price ₱</label>
                        <input type="number" class="form-control mb-3 border" id="updateunitcostfield" >
                        </div>
                   
                    <div class="input-group mb-3"> 
                    <div class="input-stock-prepend">
                        <span class="input-group-text">Stock</span>
                    </div>
                    <input type="number" class="form-control border" id="updatestockfield" style="border-radius: 5px black;">
                    <select class="status-prepend" id="updatestatusfield">
                    <option class="badge bg-success">Available</option>
                        <option class="badge bg-warning">Low</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nameProduct mb-3">Supplier Name</label>
                        <input type="text" class="form-control mb-3 border" id="updatesupplierfield" >
                        </div>

                        
                        <div class="form-group mb-3">
                            <label for="nameProduct mb-3">Product Image</label>
                            <input type="file" class="form-control mb-3 border" id="updateimagefield" name="img" accept="image/*">
                            </div>
                            
                        <div class="form-group mb-3">
                            <label for="productDescription mb-3">Product Description</label>
                           <textarea name="descriptionfield" id="updatedescriptionfield" cols="30" rows="5" style="resize: none;"></textarea>
                            </div>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateDetails()">Update</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">
                       </div>
                    </div>
                  </div>
                </div>

                <!-- SORT STATUS -->
                    <div class="status">
                        <label class="status">Status</label>
                        <select name="status" id="">                     
                                <option value="available">Available</option>
                                <option value="low">Low</option>
                                <option value="outstock">Out of stock</option>
                        </select>
                    </div>

                    <!-- SEARCH ITEM -->
                    <div class="item-name">
                        <label class="itemName">Item name</label>
                        <input type="text">
                    </div>
            </div>

            <!-- INVENTORY TABLE -->
            <!-- <div class="inventory-container">
                <div id="result"></div>
            </div> -->

            <div id="result"></div>

                 <!-- <div id="displayDataTable"></div> -->
    </section>

    <script src="/assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="/js/product.js"></script>

</body>
</html>