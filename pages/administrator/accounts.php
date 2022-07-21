<?php session_start(); ?>
<!-- Coding by RJ Avanceña Enterprises -->
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '--header.php'; ?>

    <title>Account Management</title> 

</head>
<body class="<?php $global_mode = "light"; echo $global_mode;?>">

<?php include '--sidebar.php'; ?>

    <section class="home">
        <div class="text">


        <div class="row mb-3">
                            <div class="col-sm-4">Account Management</div>
                            
                            <div class="col-sm-2">
                                    <button class="btn btn-primary btn-lg w-100" onclick="createModal();">Add Account</button>
                            </div>

                            <div class="col-sm-2">
                                    <select id="userlevel" name="userlevel" class="form-select form-select-lg" aria-label="User Level" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                            <option class="dropdown-header" disabled>User Level</option>  
                                            <option <?php if($_SESSION['user']=="admin") echo "selected" ;?> value="admin">Admin</option>
                                            <option <?php if($_SESSION['user']=="cashier") echo "selected" ;?> value="cashier">Cashier</option>
                                            <option <?php if($_SESSION['user']=="customer") echo "selected" ;?> value="customer">Customer</option>
                                    </select>
                            </div>

                            <div class="col-sm-4">
                                    <div class="input-group search-box">
                                            <input type="text" class="form-control form-control-lg" placeholder="Name Search" aria-label="searchbar" aria-describedby="searchbar" >
                                            <button class="btn btn-primary" type="button" id="search" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">Search <i class="bi bi-search"></i></button>
                                            <div class="result"></div>
                                    </div>
                            </div>
                    </div>

                    <?php
                    require_once "--config.php";  
                    error_reporting(0);
                    

                    $per_page_record = 10;
                    // Number of entries to show in a page.   
                    // Look for a GET variable page if not found default is 1.        
                    if (isset($_GET["page"])) {
                        $page  = $_GET["page"];
                    }    
                    else {    
                        $page=1;
                    }    
                                    
                    $start_from = ($page-1) * $per_page_record;

                $userlevel = $_POST['option'];
                if($_REQUEST['user']=="data"){
                    $_SESSION['user'] = $userlevel;
                    echo "Selected value = ".$_SESSION['user'];
                }elseif ($userlevel=="") {

                        if($_SESSION['user'] == "admin"){
                            $sql_query = "SELECT * FROM accounts WHERE userlevel = 'admin' LIMIT $start_from, $per_page_record";
                            $count_query = "SELECT COUNT(*) FROM accounts WHERE userlevel = 'admin' ";
                            $alert = "primary";
                        }
                        elseif($_SESSION['user'] == "cashier"){
                            $sql_query = "SELECT * FROM accounts WHERE userlevel = 'cashier' LIMIT $start_from, $per_page_record";
                            $count_query = "SELECT COUNT(*) FROM accounts WHERE userlevel = 'cashier' ";
                            $alert = "warning";
                        }
                        elseif($_SESSION['user'] == "customer"){
                            $sql_query = "SELECT * FROM accounts WHERE userlevel = 'customer' LIMIT $start_from, $per_page_record";
                            $count_query = "SELECT COUNT(*) FROM accounts WHERE userlevel = 'customer' ";
                            $alert = "success";
                        }else{
                            $sql_query = "SELECT * FROM accounts WHERE userlevel = 'admin' LIMIT $start_from, $per_page_record";
                            $count_query = "SELECT COUNT(*) FROM accounts WHERE userlevel = 'admin' ";
                        }
                        
                        $sql_result = mysqli_query($link, $sql_query);
                        $count_result = mysqli_query($link, $count_query);

                        $count_row = mysqli_fetch_row($count_result);
                        $global_total_records = $total_records;  
                        $total_records = $count_row[0];        
                        $total_pages = ceil($total_records / $per_page_record);
                        $render_pages = $page * $per_page_record;

                        if($render_pages>$total_records){
                            $records = $total_records;
                        } elseif($render_pages<$total_records){
                            $records = $render_pages;
                        }
                        
                        if(($sql_result) && ($count_result)){
                        echo '<div class="alert alert-'.$alert.' h6 mt-2" role="alert" style="margin: 0px; border-radius: 0px;">';
                        
                                echo '<div class="row">';
                                        echo '<div class="col-sm-3">';
                                            echo 'USER LEVEL: <b>'. strtoupper($_SESSION['user']).'</b>';
                                        echo '</div>';
                                            echo '<div class="col-sm-3">';
                                        echo 'TOTAL RECORDS: <b>'.$records."/".$total_records.'</b>';
                                        echo '</div>';
                                        echo '<div class="col-sm-4">';
                                            echo '<span id="networkicon"></span> Status: <span id="network"></span>';
                                        echo '</div>';
                                            echo '<div class="col-sm-2">';
                                        echo 'PAGE: <b>'.sprintf("%02d", $page)."/".sprintf("%02d", $total_pages).'</b>';
                                echo '</div>';
                                echo '</div>';
                        
                        echo '</div>';                       

                        echo '<table class="table table-striped table-'.$global_mode.'">';  
                            echo '<thead>';
                                echo '<tr class="h5">';
                                        echo '<th width="8%" class>ID</th>';
                                        echo '<th width="20%">Full Name</th>';
                                        echo '<th width="15%">Username</th>';
                                        echo '<th width="15%">Email</th>';
                                        echo '<th width="10%">Contact</th>';
                                        echo '<th width="15%">Barangay</th>';
                                        echo '<th width="15%">Action</th>'; 

                                echo '</tr>';
                            echo '</thead>';  
                            echo '<tbody>';

                        while ($row = mysqli_fetch_array($sql_result)){

                            
                            if($row["id"] == $_GET['id']){

                                global $global_id;
                                $global_id = $row["id"];

                                global $global_firstname;
                                $global_firstname = $row["firstname"];

                                global $global_lastname;
                                $global_lastname = $row["lastname"];

                                global $global_fullname;
                                $global_fullname = $row["fullname"];

                                global $global_username;
                                $global_username = $row["username"];

                                global $global_password;
                                $global_password = $row["password"];

                                global $global_email;
                                $global_email = $row["email"];

                                global $global_contact;
                                $global_contact = $row["contact"];

                                global $global_day;
                                $global_day = $row["birthday"];

                                global $global_month;
                                $global_month = $row["birthmonth"];

                                global $global_year;
                                $global_year = $row["birthyear"];

                                global $global_birthday;
                                $global_birthday = $row["birthdate"];

                                global $global_house;
                                $global_house = $row["house"];

                                global $global_street;
                                $global_street = $row["street"];

                                global $global_barangay;
                                $global_barangay = $row["barangay"];

                                global $global_city;
                                $global_city = $row["city"];

                                global $global_province;
                                $global_province = $row["province"];

                                global $global_address;
                                $global_address = $row["address"];

                                global $global_userlevel;
                                $global_userlevel = $row["userlevel"];

                                global $global_status;
                                $global_status = $row["status"];

                                global $global_theme;
                                $global_theme = $row["theme"];

                                global $global_interface;
                                $global_interface = $row["interface"];

                                global $global_date;
                                $global_date = $row["date"];

                                global $global_time;
                                $global_time = $row["time"];
                            }
                                // Display each field of the records.      
                                echo '<tr class="h6">';  
                                echo '<td>'.$row["id"].'</td>'; 
                                echo '<td>'.$row["firstname"]." ".$row["lastname"].'</td>';
                                echo '<td>'.$row["username"].'</td>';
                                echo '<td>'.$row["email"].'</td>';
                                echo '<td>0'.$row["contact"].'</td>'; 
                                echo '<td>'.$row["barangay"].'</td>';
                                echo '<td>';
                                    echo '<a href="accounts.php?page='.$page.'&user='.$_SESSION['user'].'&id='.$row["id"].'&#view" onclick="viewModal();"><i class="bi bi-eye-fill btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View"></i></a>&nbsp;';
                                    echo '<a href="accounts.php?page='.$page.'&user='.$_SESSION['user'].'&id='.$row["id"].'&#edit" onclick="editModal();"><i class="bi bi-pencil-square btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>&nbsp;';
                                    echo '<a href="accounts.php?page='.$page.'&user='.$_SESSION['user'].'&id='.$row["id"].'&#delete" onclick="deleteModal();"><i class="bi bi-trash btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a>';
                                echo '</td>';
                        echo '</tr>';
                            
                        }
                            echo '</tbody>';
                            echo '</table>';

                    }
                }
                    ?>
                    
                    <?php           
                    echo '<ul class="pagination justify-content-center">';
                        if($page>=2){   
                            echo '<li class="page-item "><a class = "page-link" href="accounts.php?page='.($page-1).'" style="border-top-right-radius: 0px; border-top-left-radius: 8px; border-bottom-right-radius: 0px; border-bottom-left-radius: 8px;">­­<i class="bi bi-caret-left-fill"></i></a></li>';
                        }
                        elseif($page=1){   
                            echo '<li class="page-item"><a class = "page-link"href="accounts.php?page='.($page=1).'" style="border-top-right-radius: 0px; border-top-left-radius: 8px; border-bottom-right-radius: 0px; border-bottom-left-radius: 8px;">­­<i class="bi bi-caret-left-fill"></i></a></li>';
                        }        
                            
                        echo '<div class="input-group" style="width: 120px; text-align: center;">';
                            echo '<input id="page" data-bs-toggle="tooltip" data-bs-placement="top" title="Page" style="text-align: center; border-radius: 0px;" class="form-control" type="number" min="1" max="'.$total_pages.'" placeholder="'.$page.'" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;">';
                            echo '<button class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Go to" onClick="go2Page();" style="border-radius: 0px;"> <i class="bi bi-search"></i> </button>';
                        echo '</div>';
                        

                        if($page<$total_pages){   
                            echo '<li class="page-item"><a class = "page-link" href="accounts.php?page='.($page+1).'" style="border-top-right-radius: 8px; border-top-left-radius: 0px; border-bottom-right-radius: 8px; border-bottom-left-radius: 0px;"><i class="bi bi-caret-right-fill"></i></a></li>';
                        }elseif($page=$total_pages){   
                            echo '<li class="page-item"><a class = "page-link" href="accounts.php?page='.($page=$total_pages).'" style="border-top-right-radius: 8px; border-top-left-radius: 0px; border-bottom-right-radius: 8px; border-bottom-left-radius: 0px;"><i class="bi bi-caret-right-fill"></i></a></li>';
                        } 
                    echo '<ul>';
                ?>
                
                
                

<!---------------------------------------------- VIEW MODAL HTML ---------------------------------------------->
<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="createModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                        <div class="modal-header" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <div class="modal-title h4" id="createModalLabel">Create Account</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body h6" style="background-color: var(--sidebar-color); color: var(--text-color); margin: 0px;">
                                                <form class="needs-validation" novalidate action="--create-account.php" method="POST">

                                                        <script>
                                                        (function () {
                                                        'use strict'

                                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                        var forms = document.querySelectorAll('.needs-validation')

                                                        // Loop over them and prevent submission
                                                        Array.prototype.slice.call(forms)
                                                            .forEach(function (form) {
                                                            form.addEventListener('submit', function (event) {
                                                                if (!form.checkValidity()) {
                                                                event.preventDefault()
                                                                event.stopPropagation()
                                                                }

                                                                form.classList.add('was-validated')
                                                            }, false)
                                                            })
                                                        })()
                                                        </script>

                                                
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                                            <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <input required type="text" name="firstname" class="form-control" placeholder="First Name" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                        <input required type="text" name="lastname" class="form-control" placeholder="Last Name" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                        <div class="invalid-feedback" style="font-size: 12px;">Please enter corresponding names!</div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Username</label>
                                                                <div class="col-sm-9">
                                                                        <input required type="text" name="username" class="form-control" placeholder="Username" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                    <div class="invalid-feedback" style="font-size: 12px;">Please enter username.</div>
                                                                </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                                <input required type="password" name="password" class="form-control" placeholder="Password" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter password!</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                                            <div class="col-sm-9">
                                                                <input required type="text" name="email" class="form-control" placeholder="Email Address" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter email.</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Contact No.</label>
                                                            <div class="col-sm-9">
                                                                <input required type="number" name="contact" min="9000000000" max="9999999999" onKeyPress="if(this.value.length==10) return false;" class="form-control" placeholder="9XXXXXXXXX" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter contact number.</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Birthday</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <select required class="form-select" name="month" aria-label="month" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                        <option value="" class="dropdown-header" disabled selected value>Month</option>
                                                                        <option value="01">January</option>
                                                                        <option value="02">February</option>
                                                                        <option value="03">March</option>
                                                                        <option value="04">April</option>
                                                                        <option value="05">May</option>
                                                                        <option value="06">June</option>
                                                                        <option value="07">July</option>
                                                                        <option value="08">August</option>
                                                                        <option value="09">September</option>
                                                                        <option value="10">October</option>
                                                                        <option value="11">November</option>
                                                                        <option value="12">December</option>
                                                                    </select>
                                                                    <select required class="form-select" name="day" aria-label="day" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                        <option value="" class="dropdown-header" disabled selected>Day</option>
                                                                        <option value="01">1</option>
                                                                        <option value="02">2</option>
                                                                        <option value="03">3</option>
                                                                        <option value="04">4</option>
                                                                        <option value="05">5</option>
                                                                        <option value="06">6</option>
                                                                        <option value="07">7</option>
                                                                        <option value="08">8</option>
                                                                        <option value="09">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                        <option value="13">13</option>
                                                                        <option value="14">14</option>
                                                                        <option value="15">15</option>
                                                                        <option value="16">16</option>
                                                                        <option value="17">17</option>
                                                                        <option value="18">18</option>
                                                                        <option value="19">19</option>
                                                                        <option value="20">20</option>
                                                                        <option value="21">21</option>
                                                                        <option value="22">22</option>
                                                                        <option value="23">23</option>
                                                                        <option value="24">24</option>
                                                                        <option value="25">25</option>
                                                                        <option value="26">26</option>
                                                                        <option value="27">27</option>
                                                                        <option value="28">28</option>
                                                                        <option value="29">29</option>
                                                                        <option value="30">30</option>
                                                                        <option value="31">31</option>
                                                                    </select>
                                                                    <select required class="form-select" name="year" aria-label="year" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                                                                        <option value="" class="dropdown-header" disabled selected>Year</option>
                                                                        <option value="2022">2022</option>
                                                                        <option value="2021">2021</option>
                                                                        <option value="2020">2020</option>
                                                                        <option value="2019">2019</option>
                                                                        <option value="2018">2018</option>
                                                                        <option value="2017">2017</option>
                                                                        <option value="2016">2016</option>
                                                                        <option value="2015">2015</option>
                                                                        <option value="2014">2014</option>
                                                                        <option value="2013">2013</option>
                                                                        <option value="2012">2012</option>
                                                                        <option value="2011">2011</option>
                                                                        <option value="2010">2010</option>
                                                                        <option value="2009">2009</option>
                                                                        <option value="2008">2008</option>
                                                                        <option value="2007">2007</option>
                                                                        <option value="2006">2006</option>
                                                                        <option value="2005">2005</option>
                                                                        <option value="2004">2004</option>
                                                                        <option value="2003">2003</option>
                                                                        <option value="2002">2002</option>
                                                                        <option value="2001">2001</option>
                                                                        <option value="2000">2000</option>
                                                                        <option value="1999">1999</option>
                                                                        <option value="1998">1998</option>
                                                                        <option value="1997">1997</option>
                                                                        <option value="1996">1996</option>
                                                                        <option value="1995">1995</option>
                                                                        <option value="1994">1994</option>
                                                                        <option value="1993">1993</option>
                                                                        <option value="1992">1992</option>
                                                                        <option value="1991">1991</option>
                                                                        <option value="1990">1990</option>
                                                                        <option value="1989">1989</option>
                                                                        <option value="1988">1988</option>
                                                                        <option value="1987">1987</option>
                                                                        <option value="1986">1986</option>
                                                                        <option value="1985">1985</option>
                                                                        <option value="1984">1984</option>
                                                                        <option value="1983">1983</option>
                                                                        <option value="1982">1982</option>
                                                                        <option value="1981">1981</option>
                                                                        <option value="1980">1980</option>
                                                                        <option value="1979">1979</option>
                                                                        <option value="1978">1978</option>
                                                                        <option value="1977">1977</option>
                                                                        <option value="1976">1976</option>
                                                                        <option value="1975">1975</option>
                                                                        <option value="1974">1974</option>
                                                                        <option value="1973">1973</option>
                                                                        <option value="1972">1972</option>
                                                                        <option value="1971">1971</option>
                                                                        <option value="1970">1970</option>
                                                                        <option value="1969">1969</option>
                                                                        <option value="1968">1968</option>
                                                                        <option value="1967">1967</option>
                                                                        <option value="1966">1966</option>
                                                                        <option value="1965">1965</option>
                                                                        <option value="1964">1964</option>
                                                                        <option value="1963">1963</option>
                                                                        <option value="1962">1962</option>
                                                                        <option value="1961">1961</option>
                                                                        <option value="1960">1960</option>
                                                                        <option value="1959">1959</option>
                                                                        <option value="1958">1958</option>
                                                                        <option value="1957">1957</option>
                                                                        <option value="1956">1956</option>
                                                                        <option value="1955">1955</option>
                                                                        <option value="1954">1954</option>
                                                                        <option value="1953">1953</option>
                                                                        <option value="1952">1952</option>
                                                                        <option value="1951">1951</option>
                                                                        <option value="1950">1950</option>
                                                                    </select>
                                                                    <div class="invalid-feedback" style="font-size: 12px;">Please enter birthday.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Address</label>
                                                            <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input required type="text" name="house" class="form-control" placeholder="House No, Block, Lot, Subdivision" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <input required type="text" name="street" class="form-control" placeholder="Street" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter house address.</div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group mb-1">
                                                                    <select required class="form-select" name="barangay" aria-label="Barangay" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                                    <option class="dropdown-header"disabled selected value="">Barangay</option>
                                                                                    <option value="Assumption">Assumption</option>
                                                                                    <option value="Bagong Buhay I">Bagong Buhay I</option>
                                                                                    <option value="Bagong Buhay II">Bagong Buhay II</option>
                                                                                    <option value="Bagong Buhay III">Bagong Buhay III</option>
                                                                                    <option value="Citrus">Citrus</option>
                                                                                    <option value="Ciudad Real">Ciudad Real</option>
                                                                                    <option value="Dulong Bayan">Dulong Bayan</option>
                                                                                    <option value="Fátima I">Fátima I</option>
                                                                                    <option value="Fátima II">Fátima II</option>
                                                                                    <option value="Fátima III">Fátima III</option>
                                                                                    <option value="Fátima IV">Fátima IV</option>
                                                                                    <option value="Fátima V">Fátima V</option>
                                                                                    <option value="Francisco Homes-Guijo">Francisco Homes-Guijo</option>
                                                                                    <option value="Francisco Homes-Mulawin">Francisco Homes-Mulawin</option>
                                                                                    <option value="Francisco Homes-Narra">Francisco Homes-Narra</option>
                                                                                    <option value="Francisco Homes-Yakal">Francisco Homes-Yakal</option>
                                                                                    <option value="Gaya-Gaya">Gaya-Gaya</option>
                                                                                    <option value="Graceville I">Graceville I</option>
                                                                                    <option value="Gumaoc-Central">Gumaoc-Central</option>
                                                                                    <option value="Gumaoc-East">Gumaoc-East</option>
                                                                                    <option value="Gumaoc-West">Gumaoc-West</option>
                                                                                    <option value="Kaybanban">Kaybanban</option>
                                                                                    <option value="Kaypian">Kaypian</option>
                                                                                    <option value="Lawang Pari">Lawang Pari</option>
                                                                                    <option value="Maharlika">Maharlika</option>
                                                                                    <option value="Minuyan I">Minuyan I</option>
                                                                                    <option value="Minuyan II">Minuyan II</option>
                                                                                    <option value="Minuyan III">Minuyan III</option>
                                                                                    <option value="Minuyan IV">Minuyan IV</option>
                                                                                    <option value="Minuyan V">Minuyan V</option>
                                                                                    <option value="Minuyan Proper">Minuyan Proper</option>
                                                                                    <option value="Muzón">Muzón</option>
                                                                                    <option value="Paradise III">Paradise III</option>
                                                                                    <option value="Población">Población</option>
                                                                                    <option value="Población I">Población I</option>
                                                                                    <option value="San Isidro">San Isidro</option>
                                                                                    <option value="San Manuel">San Manuel</option>
                                                                                    <option value="San Martín I">San Martín I</option>
                                                                                    <option value="San Martín II">San Martín II</option>
                                                                                    <option value="San Martín III">San Martín III</option>
                                                                                    <option value="San Martín IV">San Martín IV</option>
                                                                                    <option value="San Pedro">San Pedro</option>
                                                                                    <option value="San Rafael I">San Rafael I</option>
                                                                                    <option value="San Rafael II">San Rafael II</option>
                                                                                    <option value="San Rafael III">San Rafael III</option>
                                                                                    <option value="San Rafael IV">San Rafael IV</option>
                                                                                    <option value="San Rafael V">San Rafael V</option>
                                                                                    <option value="Santo Cristo">Santo Cristo</option>
                                                                                    <option value="Santo Niño I">Santo Niño I</option>
                                                                                    <option value="Santo Niño II">Santo Niño II</option>
                                                                                    <option value="Sapang Palay Proper">Sapang Palay Proper</option>
                                                                                    <option value="St. Martin de Porres">St. Martin de Porres</option>
                                                                                    <option value="Tungkong Mangga">Tungkong Mangga</option>
                                                                        </select>
                                                                            <input required type="text" name="city" class="form-control" placeholder="City" style="background-color: var(--sidebar-color); color: var(--text-color); border-radius: 0px;"></input>
                                                                            <input required type="text" name="province" class="form-control" placeholder="Province" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                            <div class="invalid-feedback" style="font-size: 12px;">Please enter local address.</div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">User Level</label>
                                                            <div class="col-sm-9">
                                                                <select required class="form-select" name="userlevel" aria-label="User Level" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                    <option class="dropdown-header"disabled selected value="">User Level</option>
                                                                    <option value="admin">Administrator</option>
                                                                    <option value="cashier">Cashier</option>
                                                                </select>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please select user level.</div>
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <button type="submit" value="submit" class="btn btn-primary w-25">Save</button>
                                                <button type="reset" class="btn btn-danger w-25" onclick="history.go(0);">Reset</button>
                                                <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                </div>
                        </div>
                </div>


                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                        <div class="modal-header" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <div class="modal-title h4" id="viewModalTitle">View Account Information</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body h6" style="background-color: var(--sidebar-color); color: var(--text-color); margin: 0px;">
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                                            <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <input disabled type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $global_fullname; ?>" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Username</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $global_username; ?>" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="email" class="form-control" placeholder="Email Address" value="<?php echo $global_email; ?>" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Contact No.</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="number" onKeyPress="if(this.value.length==11) return false;" name="contact" class="form-control"  value="<?php echo "0".$global_contact; ?>"placeholder="9XXXXXXXX" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Birthday</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="birthday" class="form-control"  value="<?php echo $global_birthday; ?>"placeholder="Age" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Address</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group mb-1">
                                                                    <textarea disabled type="text" name="barangay" class="form-control w-auto h-auto" placeholder="Address" style="background-color: var(--sidebar-color); color: var(--text-color);"><?php echo $global_address; ?></textarea>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">User Level</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="userlevel" class="form-control" placeholder="User Level" value="<?php echo ucwords($global_userlevel);?>" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Account Status</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="status" class="form-control" placeholder="Status" value="<?php echo $global_status; ?>" style="background-color: var(--sidebar-color);  <?php if($global_status == "Active"){ echo "color: green;";}elseif($global_status == "Inactive"){ echo "color: red;";}?> font-weight: 600; border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Date Created</label>
                                                            <div class="col-sm-9">
                                                                <input disabled type="text" name="status" class="form-control" placeholder="Status" value="<?php echo $global_date.", ".date('h:i:s A', strtotime($global_time)) ?>" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                        </div>
                </div>




                <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                        <div class="modal-header" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <div class="modal-title h4" id="editModal">Edit Account Information</div>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body h6" style="background-color: var(--sidebar-color); color: var(--text-color); margin: 0px;">
                                                <form class="needs-validation" novalidate action="--insert-account.php?id=<?php echo $_GET['id']; ?>" method="POST">

                                                        <script>
                                                        (function () {
                                                        'use strict'

                                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                        var forms = document.querySelectorAll('.needs-validation')

                                                        // Loop over them and prevent submission
                                                        Array.prototype.slice.call(forms)
                                                            .forEach(function (form) {
                                                            form.addEventListener('submit', function (event) {
                                                                if (!form.checkValidity()) {
                                                                event.preventDefault()
                                                                event.stopPropagation()
                                                                }

                                                                form.classList.add('was-validated')
                                                            }, false)
                                                            })
                                                        })()
                                                        </script>

                                                
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Full Name</label>
                                                            <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <input value="<?php echo $global_firstname; ?>" required type="text" name="firstname" class="form-control" placeholder="First Name" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                        <input value="<?php echo $global_lastname; ?>" required type="text" name="lastname" class="form-control" placeholder="Last Name" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                        <div class="invalid-feedback" style="font-size: 12px;">Please enter corresponding names!</div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Username</label>
                                                                <div class="col-sm-9">
                                                                    <input value="<?php echo $global_username; ?>" required type="text" name="username" class="form-control" placeholder="Username" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                    <div class="invalid-feedback" style="font-size: 12px;">Please enter username.</div>
                                                                </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                                <input required type="password" name="password" class="form-control" placeholder="Password" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter password!</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Email Address</label>
                                                            <div class="col-sm-9">
                                                                <input value="<?php echo $global_email; ?>" required type="text" name="email" class="form-control" placeholder="Email Address" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter email.</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Contact No.</label>
                                                            <div class="col-sm-9">
                                                                <input value="<?php echo $global_contact; ?>" required type="number" min="9000000000" max="9999999999" onKeyPress="if(this.value.length==10) return false;" name="contact" class="form-control" placeholder="9XXXXXXXXX" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter contact number.</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Birthday</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <select class="form-select" name="month" aria-label="month" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                        <option class="dropdown-header" disabled>Month</option>
                                                                        <option value="01" <?php if($global_month == 1){echo "selected";} ?> >January</option>
                                                                        <option value="02" <?php if($global_month == 2){echo "selected";} ?> >February</option>
                                                                        <option value="03" <?php if($global_month == 3){echo "selected";} ?> >March</option>
                                                                        <option value="04" <?php if($global_month == 4){echo "selected";} ?> >April</option>
                                                                        <option value="05" <?php if($global_month == 5){echo "selected";} ?> >May</option>
                                                                        <option value="06" <?php if($global_month == 6){echo "selected";} ?> >June</option>
                                                                        <option value="07" <?php if($global_month == 7){echo "selected";} ?> >July</option>
                                                                        <option value="08" <?php if($global_month == 8){echo "selected";} ?> >August</option>
                                                                        <option value="09" <?php if($global_month == 9){echo "selected";} ?> >September</option>
                                                                        <option value="10" <?php if($global_month == 10){echo "selected";} ?> >October</option>
                                                                        <option value="11" <?php if($global_month == 11){echo "selected";} ?> >November</option>
                                                                        <option value="12" <?php if($global_day == 1){echo "selected";} ?> >December</option>
                                                                    </select>
                                                                    <select class="form-select" name="day" aria-label="day" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                        <option class="dropdown-header" disabled selected>Day</option>
                                                                        <option value="01" <?php if($global_day == 1){echo "selected";} ?> >1</option>
                                                                        <option value="02" <?php if($global_day == 2){echo "selected";} ?> >2</option>
                                                                        <option value="03" <?php if($global_day == 3){echo "selected";} ?> >3</option>
                                                                        <option value="04" <?php if($global_day == 4){echo "selected";} ?> >4</option>
                                                                        <option value="05" <?php if($global_day == 5){echo "selected";} ?> >5</option>
                                                                        <option value="06" <?php if($global_day == 6){echo "selected";} ?> >6</option>
                                                                        <option value="07" <?php if($global_day == 7){echo "selected";} ?> >7</option>
                                                                        <option value="08" <?php if($global_day == 8){echo "selected";} ?> >8</option>
                                                                        <option value="09" <?php if($global_day == 9){echo "selected";} ?> >9</option>
                                                                        <option value="10" <?php if($global_day == 10){echo "selected";} ?> >10</option>
                                                                        <option value="11" <?php if($global_day == 11){echo "selected";} ?> >11</option>
                                                                        <option value="12" <?php if($global_day == 12){echo "selected";} ?> >12</option>
                                                                        <option value="13" <?php if($global_day == 13){echo "selected";} ?> >13</option>
                                                                        <option value="14" <?php if($global_day == 14){echo "selected";} ?> >14</option>
                                                                        <option value="15" <?php if($global_day == 15){echo "selected";} ?> >15</option>
                                                                        <option value="16" <?php if($global_day == 16){echo "selected";} ?> >16</option>
                                                                        <option value="17" <?php if($global_day == 17){echo "selected";} ?> >17</option>
                                                                        <option value="18" <?php if($global_day == 18){echo "selected";} ?> >18</option>
                                                                        <option value="19" <?php if($global_day == 19){echo "selected";} ?> >19</option>
                                                                        <option value="20" <?php if($global_day == 20){echo "selected";} ?> >20</option>
                                                                        <option value="21" <?php if($global_day == 21){echo "selected";} ?> >21</option>
                                                                        <option value="22" <?php if($global_day == 22){echo "selected";} ?> >22</option>
                                                                        <option value="23" <?php if($global_day == 23){echo "selected";} ?> >23</option>
                                                                        <option value="24" <?php if($global_day == 24){echo "selected";} ?> >24</option>
                                                                        <option value="25" <?php if($global_day == 25){echo "selected";} ?> >25</option>
                                                                        <option value="26" <?php if($global_day == 26){echo "selected";} ?> >26</option>
                                                                        <option value="27" <?php if($global_day == 27){echo "selected";} ?> >27</option>
                                                                        <option value="28" <?php if($global_day == 28){echo "selected";} ?> >28</option>
                                                                        <option value="29" <?php if($global_day == 29){echo "selected";} ?> >29</option>
                                                                        <option value="30" <?php if($global_day == 30){echo "selected";} ?> >30</option>
                                                                        <option value="31" <?php if($global_day == 31){echo "selected";} ?> >31</option>
                                                                    </select>
                                                                    <select class="form-select" name="year" aria-label="year" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;">
                                                                        <option class="dropdown-header" disabled selected>Year</option>
                                                                        <option value="2022" <?php if($global_year == 2022){echo "selected";} ?> >2022</option>
                                                                        <option value="2021" <?php if($global_year == 2021){echo "selected";} ?> >2021</option>
                                                                        <option value="2020" <?php if($global_year == 2020){echo "selected";} ?> >2020</option>
                                                                        <option value="2019" <?php if($global_year == 2019){echo "selected";} ?> >2019</option>
                                                                        <option value="2018" <?php if($global_year == 2018){echo "selected";} ?> >2018</option>
                                                                        <option value="2017" <?php if($global_year == 2017){echo "selected";} ?> >2017</option>
                                                                        <option value="2016" <?php if($global_year == 2016){echo "selected";} ?> >2016</option>
                                                                        <option value="2015" <?php if($global_year == 2015){echo "selected";} ?> >2015</option>
                                                                        <option value="2014" <?php if($global_year == 2014){echo "selected";} ?> >2014</option>
                                                                        <option value="2013" <?php if($global_year == 2013){echo "selected";} ?> >2013</option>
                                                                        <option value="2012" <?php if($global_year == 2012){echo "selected";} ?> >2012</option>
                                                                        <option value="2011" <?php if($global_year == 2011){echo "selected";} ?> >2011</option>
                                                                        <option value="2010" <?php if($global_year == 2010){echo "selected";} ?> >2010</option>
                                                                        <option value="2009" <?php if($global_year == 2009){echo "selected";} ?> >2009</option>
                                                                        <option value="2008" <?php if($global_year == 2008){echo "selected";} ?> >2008</option>
                                                                        <option value="2007" <?php if($global_year == 2007){echo "selected";} ?> >2007</option>
                                                                        <option value="2006" <?php if($global_year == 2006){echo "selected";} ?> >2006</option>
                                                                        <option value="2005" <?php if($global_year == 2005){echo "selected";} ?> >2005</option>
                                                                        <option value="2004" <?php if($global_year == 2004){echo "selected";} ?> >2004</option>
                                                                        <option value="2003" <?php if($global_year == 2003){echo "selected";} ?> >2003</option>
                                                                        <option value="2002" <?php if($global_year == 2002){echo "selected";} ?> >2002</option>
                                                                        <option value="2001" <?php if($global_year == 2001){echo "selected";} ?> >2001</option>
                                                                        <option value="2000" <?php if($global_year == 2000){echo "selected";} ?> >2000</option>
                                                                        <option value="1999" <?php if($global_year == 1999){echo "selected";} ?> >1999</option>
                                                                        <option value="1998" <?php if($global_year == 1998){echo "selected";} ?> >1998</option>
                                                                        <option value="1997" <?php if($global_year == 1997){echo "selected";} ?> >1997</option>
                                                                        <option value="1996" <?php if($global_year == 1996){echo "selected";} ?> >1996</option>
                                                                        <option value="1995" <?php if($global_year == 1995){echo "selected";} ?> >1995</option>
                                                                        <option value="1994" <?php if($global_year == 1994){echo "selected";} ?> >1994</option>
                                                                        <option value="1993" <?php if($global_year == 1993){echo "selected";} ?> >1993</option>
                                                                        <option value="1992" <?php if($global_year == 1992){echo "selected";} ?> >1992</option>
                                                                        <option value="1991" <?php if($global_year == 1991){echo "selected";} ?> >1991</option>
                                                                        <option value="1990" <?php if($global_year == 1990){echo "selected";} ?> >1990</option>
                                                                        <option value="1989" <?php if($global_year == 1989){echo "selected";} ?> >1989</option>
                                                                        <option value="1988" <?php if($global_year == 1988){echo "selected";} ?> >1988</option>
                                                                        <option value="1987" <?php if($global_year == 1987){echo "selected";} ?> >1987</option>
                                                                        <option value="1986" <?php if($global_year == 1986){echo "selected";} ?> >1986</option>
                                                                        <option value="1985" <?php if($global_year == 1985){echo "selected";} ?> >1985</option>
                                                                        <option value="1984" <?php if($global_year == 1984){echo "selected";} ?> >1984</option>
                                                                        <option value="1983" <?php if($global_year == 1983){echo "selected";} ?> >1983</option>
                                                                        <option value="1982" <?php if($global_year == 1982){echo "selected";} ?> >1982</option>
                                                                        <option value="1981" <?php if($global_year == 1981){echo "selected";} ?> >1981</option>
                                                                        <option value="1980" <?php if($global_year == 1980){echo "selected";} ?> >1980</option>
                                                                        <option value="1979" <?php if($global_year == 1979){echo "selected";} ?> >1979</option>
                                                                        <option value="1978" <?php if($global_year == 1978){echo "selected";} ?> >1978</option>
                                                                        <option value="1977" <?php if($global_year == 1977){echo "selected";} ?> >1977</option>
                                                                        <option value="1976" <?php if($global_year == 1976){echo "selected";} ?> >1976</option>
                                                                        <option value="1975" <?php if($global_year == 1975){echo "selected";} ?> >1975</option>
                                                                        <option value="1974" <?php if($global_year == 1974){echo "selected";} ?> >1974</option>
                                                                        <option value="1973" <?php if($global_year == 1973){echo "selected";} ?> >1973</option>
                                                                        <option value="1972" <?php if($global_year == 1972){echo "selected";} ?> >1972</option>
                                                                        <option value="1971" <?php if($global_year == 1971){echo "selected";} ?> >1971</option>
                                                                        <option value="1970" <?php if($global_year == 1970){echo "selected";} ?> >1970</option>
                                                                        <option value="1969" <?php if($global_year == 1969){echo "selected";} ?> >1969</option>
                                                                        <option value="1968" <?php if($global_year == 1968){echo "selected";} ?> >1968</option>
                                                                        <option value="1967" <?php if($global_year == 1967){echo "selected";} ?> >1967</option>
                                                                        <option value="1966" <?php if($global_year == 1966){echo "selected";} ?> >1966</option>
                                                                        <option value="1965" <?php if($global_year == 1965){echo "selected";} ?> >1965</option>
                                                                        <option value="1964" <?php if($global_year == 1964){echo "selected";} ?> >1964</option>
                                                                        <option value="1963" <?php if($global_year == 1963){echo "selected";} ?> >1963</option>
                                                                        <option value="1962" <?php if($global_year == 1962){echo "selected";} ?> >1962</option>
                                                                        <option value="1961" <?php if($global_year == 1961){echo "selected";} ?> >1961</option>
                                                                        <option value="1960" <?php if($global_year == 1960){echo "selected";} ?> >1960</option>
                                                                        <option value="1959" <?php if($global_year == 1959){echo "selected";} ?> >1959</option>
                                                                        <option value="1958" <?php if($global_year == 1958){echo "selected";} ?> >1958</option>
                                                                        <option value="1957" <?php if($global_year == 1957){echo "selected";} ?> >1957</option>
                                                                        <option value="1956" <?php if($global_year == 1956){echo "selected";} ?> >1956</option>
                                                                        <option value="1955" <?php if($global_year == 1955){echo "selected";} ?> >1955</option>
                                                                        <option value="1954" <?php if($global_year == 1954){echo "selected";} ?> >1954</option>
                                                                        <option value="1953" <?php if($global_year == 1953){echo "selected";} ?> >1953</option>
                                                                        <option value="1952" <?php if($global_year == 1952){echo "selected";} ?> >1952</option>
                                                                        <option value="1951" <?php if($global_year == 1951){echo "selected";} ?> >1951</option>
                                                                        <option value="1950" <?php if($global_year == 1950){echo "selected";} ?> >1950</option>
                                                                    </select>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter birthday.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Address</label>
                                                            <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input value="<?php echo $global_house; ?>" required type="text" name="house" class="form-control" placeholder="House No, Block, Lot, Subdivision" style="background-color: var(--sidebar-color); color: var(--text-color);"></input>
                                                                <input value="<?php echo $global_street; ?>"required type="text" name="street" class="form-control" placeholder="Street" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please enter house address.</div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group mb-1">
                                                                    <select required class="form-select" name="barangay" aria-label="Barangay" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                                    <option class="dropdown-header"disabled value="">Barangay</option>
                                                                                    <option value="Assumption" <?php if($global_barangay == "Assumption"){echo "selected";}?> >Assumption</option>
                                                                                    <option value="Bagong Buhay I" <?php if($global_barangay == "Bagong Buhay I"){echo "selected";}?> >Bagong Buhay I</option>
                                                                                    <option value="Bagong Buhay II" <?php if($global_barangay == "Bagong Buhay II"){echo "selected";}?> >Bagong Buhay II</option>
                                                                                    <option value="Bagong Buhay III" <?php if($global_barangay == "Bagong Buhay III"){echo "selected";}?> >Bagong Buhay III</option>
                                                                                    <option value="Citrus" <?php if($global_barangay == "Citrus"){echo "selected";}?> >Citrus</option>
                                                                                    <option value="Ciudad Real" <?php if($global_barangay == "Ciudad Real"){echo "selected";}?> >Ciudad Real</option>
                                                                                    <option value="Dulong Bayan" <?php if($global_barangay == "Dulong Bayan"){echo "selected";}?> >Dulong Bayan</option>
                                                                                    <option value="Fátima I" <?php if($global_barangay == "Fátima I"){echo "selected";}?> >Fátima I</option>
                                                                                    <option value="Fátima II" <?php if($global_barangay == "Fátima II"){echo "selected";}?> >Fátima II</option>
                                                                                    <option value="Fátima III" <?php if($global_barangay == "Fátima III"){echo "selected";}?> >Fátima III</option>
                                                                                    <option value="Fátima IV" <?php if($global_barangay == "Fátima IV"){echo "selected";}?> >Fátima IV</option>
                                                                                    <option value="Fátima V" <?php if($global_barangay == "Fátima V"){echo "selected";}?> >Fátima V</option>
                                                                                    <option value="Francisco Homes-Guijo" <?php if($global_barangay == "Francisco Homes-Guijo"){echo "selected";}?> >Francisco Homes-Guijo</option>
                                                                                    <option value="Francisco Homes-Mulawin" <?php if($global_barangay == "Francisco Homes-Mulawin"){echo "selected";}?> >Francisco Homes-Mulawin</option>
                                                                                    <option value="Francisco Homes-Narra" <?php if($global_barangay == "Francisco Homes-Narra"){echo "selected";}?> >Francisco Homes-Narra</option>
                                                                                    <option value="Francisco Homes-Yakal" <?php if($global_barangay == "Francisco Homes-Yakal"){echo "selected";}?> >Francisco Homes-Yakal</option>
                                                                                    <option value="Gaya-Gaya" <?php if($global_barangay == "Gaya-Gaya"){echo "selected";}?> >Gaya-Gaya</option>
                                                                                    <option value="Graceville I" <?php if($global_barangay == "Graceville I"){echo "selected";}?> >Graceville I</option>
                                                                                    <option value="Gumaoc-Central" <?php if($global_barangay == "Gumaoc-Central"){echo "selected";}?> >Gumaoc-Central</option>
                                                                                    <option value="Gumaoc-East" <?php if($global_barangay == "Gumaoc-East"){echo "selected";}?> >Gumaoc-East</option>
                                                                                    <option value="Gumaoc-West" <?php if($global_barangay == "Gumaoc-West"){echo "selected";}?> >Gumaoc-West</option>
                                                                                    <option value="Kaybanban" <?php if($global_barangay == "Kaybanban"){echo "selected";}?> >Kaybanban</option>
                                                                                    <option value="Kaypian" <?php if($global_barangay == "Kaypian"){echo "selected";}?> >Kaypian</option>
                                                                                    <option value="Lawang Pari" <?php if($global_barangay == "Lawang Pari"){echo "selected";}?> >Lawang Pari</option>
                                                                                    <option value="Maharlika" <?php if($global_barangay == "Maharlika"){echo "selected";}?> >Maharlika</option>
                                                                                    <option value="Minuyan I" <?php if($global_barangay == "Minuyan I"){echo "selected";}?> >Minuyan I</option>
                                                                                    <option value="Minuyan II" <?php if($global_barangay == "Minuyan II"){echo "selected";}?> >Minuyan II</option>
                                                                                    <option value="Minuyan III" <?php if($global_barangay == "Minuyan III"){echo "selected";}?> >Minuyan III</option>
                                                                                    <option value="Minuyan IV" <?php if($global_barangay == "Minuyan IV"){echo "selected";}?> >Minuyan IV</option>
                                                                                    <option value="Minuyan V" <?php if($global_barangay == "Minuyan V"){echo "selected";}?> >Minuyan V</option>
                                                                                    <option value="Minuyan Proper" <?php if($global_barangay == "Minuyan Proper"){echo "selected";}?> >Minuyan Proper</option>
                                                                                    <option value="Muzón" <?php if($global_barangay == "Muzón"){echo "selected";}?> >Muzón</option>
                                                                                    <option value="Paradise III" <?php if($global_barangay == "Paradise III"){echo "selected";}?> >Paradise III</option>
                                                                                    <option value="Población" <?php if($global_barangay == "Población"){echo "selected";}?> >Población</option>
                                                                                    <option value="Población I" <?php if($global_barangay == "Población I"){echo "selected";}?> >Población I</option>
                                                                                    <option value="San Isidro" <?php if($global_barangay == "San Isidro"){echo "selected";}?> >San Isidro</option>
                                                                                    <option value="San Manuel" <?php if($global_barangay == "San Manuel"){echo "selected";}?> >San Manuel</option>
                                                                                    <option value="San Martín I" <?php if($global_barangay == "San Martín I"){echo "selected";}?> >San Martín I</option>
                                                                                    <option value="San Martín II" <?php if($global_barangay == "San Martín II"){echo "selected";}?> >San Martín II</option>
                                                                                    <option value="San Martín III" <?php if($global_barangay == "San Martín III"){echo "selected";}?> >San Martín III</option>
                                                                                    <option value="San Martín IV" <?php if($global_barangay == "San Martín IV"){echo "selected";}?> >San Martín IV</option>
                                                                                    <option value="San Pedro" <?php if($global_barangay == "San Pedro"){echo "selected";}?> >San Pedro</option>
                                                                                    <option value="San Rafael I" <?php if($global_barangay == "San Rafael I"){echo "selected";}?> >San Rafael I</option>
                                                                                    <option value="San Rafael II" <?php if($global_barangay == "San Rafael II"){echo "selected";}?> >San Rafael II</option>
                                                                                    <option value="San Rafael III" <?php if($global_barangay == "San Rafael III"){echo "selected";}?> >San Rafael III</option>
                                                                                    <option value="San Rafael IV" <?php if($global_barangay == "San Rafael IV"){echo "selected";}?> >San Rafael IV</option>
                                                                                    <option value="San Rafael V" <?php if($global_barangay == "San Rafael V"){echo "selected";}?> >San Rafael V</option>
                                                                                    <option value="Santo Cristo" <?php if($global_barangay == "Santo Cristo"){echo "selected";}?> >Santo Cristo</option>
                                                                                    <option value="Santo Niño I" <?php if($global_barangay == "Santo Niño I"){echo "selected";}?> >Santo Niño I</option>
                                                                                    <option value="Santo Niño II" <?php if($global_barangay == "Santo Niño II"){echo "selected";}?> >Santo Niño II</option>
                                                                                    <option value="Sapang Palay Proper" <?php if($global_barangay == "Sapang Palay Proper"){echo "selected";}?> >Sapang Palay Proper</option>
                                                                                    <option value="St. Martin de Porres" <?php if($global_barangay == "St. Martin de Porres"){echo "selected";}?> >St. Martin de Porres</option>
                                                                                    <option value="Tungkong Mangga" <?php if($global_barangay == "Tungkong Mangga"){echo "selected";}?> >Tungkong Mangga</option>
                                                                        </select>
                                                                            <input value="<?php echo $global_city; ?>" required type="text" name="city" class="form-control" placeholder="City" style="background-color: var(--sidebar-color); color: var(--text-color); border-radius: 0px;"></input>
                                                                            <input value="<?php echo $global_province; ?>" required type="text" name="province" class="form-control" placeholder="Province" style="background-color: var(--sidebar-color); color: var(--text-color); border-top-right-radius: 5px; border-bottom-right-radius: 5px;"></input>
                                                                            <div class="invalid-feedback" style="font-size: 12px;">Please enter local address.</div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">User Level</label>
                                                            <div class="col-sm-9">
                                                                <select required class="form-select" name="userlevel" aria-label="User Level" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                    <option class="dropdown-header"disabled selected value="">User Level</option>
                                                                    <option value="admin" <?php if($global_userlevel == "admin"){echo "selected";}?> >Administrator</option>
                                                                    <option value="cashier" <?php if($global_userlevel == "cashier"){echo "selected";}?>>Cashier</option>
                                                                </select>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please select user level.</div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <label class="col-sm-3 col-form-label">Account Status</label>
                                                            <div class="col-sm-9">
                                                                <select required class="form-select" name="status" aria-label="User Level" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                                    <option class="dropdown-header"disabled selected value="">User Level</option>
                                                                    <option value="Active" <?php if($global_status == "Active"){echo "selected";}?> >Active</option>
                                                                    <option value="Inactive" <?php if($global_status == "Inactive"){echo "selected";}?>>Inactive</option>
                                                                </select>
                                                                <div class="invalid-feedback" style="font-size: 12px;">Please select user level.</div>
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="modal-footer" style="background-color: var(--sidebar-color); color: var(--text-color);">
                                                <button type="submit" value="submit" class="btn btn-primary w-25">Save</button>
                                                <button type="reset" class="btn btn-danger w-25">Reset</button>
                                                <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </form>
                                </div>
                        </div>
                </div>
        



        </div>
    </section>

    <script src="/assets/js/script.js"></script>

    <script>   
            function go2Page(){   
                var page = document.getElementById("page").value;   
                page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
                window.location.href = 'accounts.php?page='+page;   
            }
            function createModal(){
                location.href='accounts.php?#create';
                setTimeout(function(){location.reload(); }, 50)
            }
            function viewModal(){
                setTimeout(function(){location.reload(); }, 50)
            }
            function editModal(){
                setTimeout(function(){location.reload(); }, 50)
            }
            function deleteModal(){
                setTimeout(function(){location.reload(); }, 50)
            }
    </script>

    <script>
        if (navigator.onLine) {
        console.log('online');
            var network_icon = document.getElementById("networkicon").innerHTML = '<i class="bi bi-wifi"></i>';
            var network_status = document.getElementById("network").innerHTML = '<b>Online</b>';
            var network_color = document.getElementById("network").style = "color: green;";
        } else {
        console.log('offline');
            var network_icon = document.getElementById("networkicon").innerHTML = '<i class="bi bi-wifi-off"></i>';
            var network_status = document.getElementById("network").innerHTML = '<b>Offline</b>';
            var network_color = document.getElementById("network").style = "color: red;";
        }
    </script>

    <script>
            $(document).ready(function(){
		 $("#network").load("accounts.php");
        setInterval(function() {
            $("#network").load("accounts.php");
        }, 500);
    });
    </script>

    <script type="text/javascript">
            $(document).ready(function(){
                $(document).on("change","#userlevel",function(){
                    var userlevel = $(this).val();
                    console.log(userlevel);

                        $.ajax({
                            type: 'post',
                            url: 'accounts.php?user=data',
                            datatype:'json',
                            data: {"option":userlevel},
                            success: function (response) {  
                                location.href="accounts.php";
                            }
                        });
                    });
                });
    </script>

    <script>
            $(document).ready(function(){
                $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(inputVal.length){
                        $.get("--ajax-search-account.php", {term: inputVal}).done(function(data){
                            // Display the returned data in browser
                            resultDropdown.html(data);
                        });
                    } else{
                        resultDropdown.empty();
                    }
                });
                
                // Set search input value on click of result item
                $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                });
            });
    </script>    

    <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
            })
    </script>

    <script>
                $(document).ready(function () {
                var target = document.location.hash.replace("#", "");
                if(target.length) {
                        if(target=="view"){
                                $('#viewModal').modal('show');
                        }else if(target=="edit"){
                                $('#editModal').modal('show');
                        }else if(target=="create"){
                                $('#createModal').modal('show');
                        }else if(target=="delete"){
                                Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: '<a style="color: white; text-decoration:none" href="--delete-account.php?page=<?php echo $_GET['page']?>&user=<?php echo $_SESSION['user']; ?>&id=<?php echo $_GET['id']?>&action=deleted">Yes, delete it!</a>'})
                        }
                        
                }});
    </script>
                        <?php
                            if(isset($_GET['created'])){
                                echo "<script>Swal.fire('Account Created!','The account was created!','success')</script>";
                            }if(isset($_GET['edited'])){
                                echo "<script>Swal.fire('Account Updated!','The account was updated!','success')</script>";
                            }if(isset($_GET['deleted'])){
                                echo "<script>Swal.fire('Account Deleted!','The account was deleted!','success')</script>";
                            }
                        ?>

</body>
</html>



<!--

CREATE TABLE `accounts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,

  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `userlevel` varchar(50) NOT NULL,
  `activity` int(2) NOT NULL DEFAULT 1,
  `security` varchar(10) NOT NULL DEFAULT "AVANCENA",
  
  `date` date DEFAULT current_date(),
  `time` time DEFAULT current_time(),
  	PRIMARY KEY (id)
)



CREATE TABLE `accounts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,

  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `age` int(2) NOT NULL,
  `house` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userlevel` varchar(50) NOT NULL DEFAULT "Cashier",
  `status` varchar(50) NOT NULL DEFAULT "Active",
  `theme` varchar(50) NOT NULL DEFAULT "light",
  `interface` varchar(50) NOT NULL DEFAULT "sidebar close",
  `date` date DEFAULT current_date(),
  `time` time DEFAULT current_time(),
  PRIMARY KEY (id)
)


CREATE TABLE `accounts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,

  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `house` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userlevel` varchar(50) NOT NULL DEFAULT "Cashier",
  `status` varchar(50) NOT NULL DEFAULT "Active",
  `theme` varchar(50) NOT NULL DEFAULT "light",
  `interface` varchar(50) NOT NULL DEFAULT "sidebar close",
  `date` date DEFAULT current_date(),
  `time` time DEFAULT current_time(),
  PRIMARY KEY (id)
)

CREATE TABLE `accounts` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,

  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `house` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userlevel` varchar(50) NOT NULL DEFAULT "Cashier",
  `status` varchar(50) NOT NULL DEFAULT "Active",
  `theme` varchar(50) NOT NULL DEFAULT "light",
  `interface` varchar(50) NOT NULL DEFAULT "sidebar close",
  `date` date DEFAULT current_date(),
  `time` time DEFAULT current_time(),
  PRIMARY KEY (id)
)


CREATE TABLE `accountsx` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,

  `username` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `birthmonth` int(2) NOT NULL,
  `birthday` int(2) NOT NULL,
  `birthyear` int(4) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `house` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `userlevel` varchar(50) NOT NULL DEFAULT "Cashier",
  `status` varchar(50) NOT NULL DEFAULT "Active",
  `theme` varchar(50) NOT NULL DEFAULT "light",
  `interface` varchar(50) NOT NULL DEFAULT "sidebar close",
  `date` date DEFAULT current_date(),
  `time` time DEFAULT current_time(),
  PRIMARY KEY (id)
)

-->
