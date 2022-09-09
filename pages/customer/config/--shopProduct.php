<div class="item-container" id="item-list">
  <?php
      #SPECIFY FIRST THE DATABASE
  			include './config/--configure.php';

        #START OF OUR PAGINATION FUNCTION
        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
          $page_no = $_GET['page_no'];
          } else {
            $page_no = 1;
                }
        $total_records_per_page = 16;
        $offset = ($page_no-1) * $total_records_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $adjacents = "2"; 

        $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `inventory`");
        $total_records = mysqli_fetch_array($result_count);
        $total_records = $total_records['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1

  			$stmt = $conn->prepare("SELECT * FROM inventory");
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
  <div class="mb-5 card">
    <img src="<?= $row['image_file'] ?>" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title mt-2"><b><i class="fa-solid fa-peso-sign"></i>&nbsp;&nbsp;<?= number_format($row['price'],2) ?></b></h5>
      <p class="card-text mt-2"><?= $row['product'] ?></p>

      <form action="" class="form-submit">
      <input type="hidden" class="form-control quantity" value="50">
      <input type="hidden" class="id" value="<?= $row['id'] ?>">
      <input type="hidden" class="product" value="<?= $row['product'] ?>">
      <input type="hidden" class="price" value="<?= $row['price'] ?>">
      <input type="hidden" class="image_file" value="<?= $row['image_file'] ?>">
      <input type="hidden" class="serialnumber" value="<?= $row['serialnumber'] ?>">
      <a href="#" class="btn btn-primary mt-4 d-md-block addItemBtn">Add to cart</a>
      </form>
    </div>
  </div>
  <?php endwhile; ?>
</div>
  <!-- Displaying Products End -->