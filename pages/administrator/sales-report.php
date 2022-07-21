<!-- Coding by RJ Avanceña Enterprises -->
<!DOCTYPE html>
<html lang="en">
<head>

    <?php include '--header.php'; ?>
    
    <title>Sales Report</title> 

</head>
<body>

<?php include '--sidebar.php'; ?>

    <section class="home">
    <div class="text">Sales Report</div>

<div class="salesReport-container">
    <!--SALES INFORMATION-->
    <div class="salesInformation-container">
        <h1>SALES INFORMATION</h1>
        <div class="salesStuff-container">
            <label for="salesStuff">Sales Stuff</label>
                <div class = "salesStuff">₱12000</div>
         </div>

    <div class="salesToday-container">
        <label for="salesToday">Total Sales Today</label>
            <div class = "salesToday">₱12000</div>
    </div>

    <div class="salesWeek-container">
        <label for="salesWeek">Total Sales this Week</label>
            <div class = "salesWeek">₱12000</div>
    </div>

    <div class="salesMonth-container">
        <label for="salesMonth">Total Sales this Month</label>
            <div class = "salesMonth">₱12000</div>
    </div>

    <div class="aveSales-container">
        <label for="aveSales">Average Sales per Month</label>
            <div class = "aveSales">₱12000</div>
    </div>

    <div class="suppDeliveries-container">
        <label for="suppDeliveries">Total Supplier Deliveries This Month</label>
            <div  class="suppDeliveries">₱12000</div>
    </div>
  </div>

    <div class="bestInformation-container">
        <!--BEST SELLING INFORMATION-->
        <h1>BEST SELLING INFORMATION</h1>
        <div class="sellingToday-container">
            <label for="sellingToday">Top selling Today</label>
                <div id="sellingToday">2B GLOVES WITH LATEX</div>
        </div>

        <div class="sellingWeek-container">
            <label for="sellingWeek">Top selling this Week</label>
                <div id="sellingWeek">2B CYLINDRICAL HINGES 5/8</div>
        </div>

        <div class="sellingMonth-container">
            <label for="sellingMonth">Top selling this Month</label>
                <div id="sellingMonth">2B LEVEL HOSE 1/4 YELLOW HD</div>
        </div>
    </div>
</div>
    </section>



    <script src="/assets/js/script.js"></script>

</body>
</html>
