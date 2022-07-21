<!-- Coding by RJ Avanceña Enterprises -->
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php include '--header.php'; ?>
    
    <title>Notes</title> 

</head>
<body>

<?php include '--sidebar.php'; ?>

    <section class="home">
        <div class="text">
        <div class="col-sm-12 mb-4"></div>
<!---------------------------------------------- INSERT TITLE AND CONTENT DATA TO SQL DATABASE ---------------------------------------------->
        <?php 
                require "--config.php";
                error_reporting(0);
                $title = $content = "";
                $title = mysqli_real_escape_string($link, strip_tags($_POST['title']));
                $content = mysqli_real_escape_string($link, strip_tags($_POST['content']));
                
                // TITLE AND CONTENT SQL INSERT TO DATABASE

                if(!empty(trim($title) && !empty(trim($content)))){
                        $sql = "INSERT INTO notes (title, content) VALUES ('$title', '$content')";
                        $query = mysqli_query($link, $sql);
                if($query){echo "<script>Swal.fire('Success!','The note is successfully recorded!','success')</script>";}
                }
        ?>
        
<!---------------------------------------------- PHP OF MODES: VIEW, DELETED, STAR ---------------------------------------------->
                <?php   if($_GET['mode'] == "view"){

                                // FETCH TITLE AND CONTENT DATA AND SELECT ALL FROM DATABASE TO VIEW FROM MODAL
                                $sql = "SELECT * FROM notes WHERE id = ?";

                                if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "i", $param_id); // Bind variables to the prepared statement as parameters
                                $param_id = trim($_GET["id"]); // Set parameters
                                if(mysqli_stmt_execute($stmt)){ // Attempt to execute the prepared statement
                                $result = mysqli_stmt_get_result($stmt);

                                                if(mysqli_num_rows($result) == 1){
                                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                                        $title = $row["title"]; // Retrieve individual field value
                                                        $content = $row["content"];
                                                } else{
                                                        header("location: error.php"); // URL doesn't contain valid id parameter. Redirect to error page
                                                        exit();
                                                }
                                        } else{
                                                echo "Oops! Something went wrong. Please try again later.";
                                        }
                                }

                         } elseif($_GET['mode'] == "deleted"){
                                // IF URL MODE IS EQUAL TO DELETED, IT WILL DELETE DATA WHERE ID is ? $_GET["id"]
                                $sql = "DELETE FROM notes WHERE id = ?";
                                
                                if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "i", $param_id); // Bind variables to the prepared statement as parameters
                                $param_id = trim($_GET["id"]); // Set parameters
                                if(mysqli_stmt_execute($stmt)){ // Attempt to execute the prepared statement
                                $result = mysqli_stmt_get_result($stmt);
                                
                                        } else{
                                                echo "Oops! Something went wrong. Please try again later.";
                                        }
                                }
                        } elseif($_GET['mode'] == "star"){
                                // IF URL MODE IS EQUAL TO "STAR", IT WILL SE:ECT AND UPDATE THE PRIORITY WHERE ID is ? $_GET["id"]
                                $sql = "SELECT * FROM notes WHERE id = ?";

                                if($stmt = mysqli_prepare($link, $sql)){
                                mysqli_stmt_bind_param($stmt, "i", $param_id); // Bind variables to the prepared statement as parameters
                                $param_id = trim($_GET["id"]); // Set parameters
                                if(mysqli_stmt_execute($stmt)){ // Attempt to execute the prepared statement
                                $result = mysqli_stmt_get_result($stmt);
                        
                                                if(mysqli_num_rows($result) == 1){
                                                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                                        $title = $row["title"]; // Retrieve individual field value
                                                        $content = $row["content"];
                                                        $priority = $row["priority"];

                                                        if($priority == 1){
                                                                $sql = "UPDATE notes SET priority = 0 WHERE id = $param_id";
                                                                $query = mysqli_query($link, $sql);
                                                                echo "<script>Swal.fire('Bookmark Removed!','','success')</script>";
                                                        } elseif($priority == 0){
                                                                $sql = "UPDATE notes SET priority = 1 WHERE id = $param_id";
                                                                $query = mysqli_query($link, $sql);
                                                                echo "<script>Swal.fire('Bookmark Added!','','success')</script>";
                                                        }
                                                } else{
                                                        header("location: error.php"); // URL doesn't contain valid id parameter. Redirect to error page
                                                        exit();
                                                }
                                        } else{
                                                echo "Oops! Something went wrong. Please try again later.";
                                        }

                }
        }
?>
<!---------------------------------------------- PHP OF MODES: VIEW, DELETED, STAR ---------------------------------------------->


<!---------------------------------------------- FORM INPUTS AND VALIDATION validateForm() FUNCTION ---------------------------------------------->
            <div class="row">
                    <div class="col-sm-8 mb-4">
                            <div class="card w-100 h-100" style="width: 18rem;">
                                    <div class="card-body w-100 h-100">
                                        <form id="notes" name="notes" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                            <div class="row">
                                                    <div class="col-sm-12">Personal Notes <i class="bi bi-pen"></i></div>
                                            </div>
                                            <div class="row">
<!---------------------------------------------- TITLE INPUT ---------------------------------------------->
                                                    <div class="input-group mb-3 mt-2">
                                                        <span class="input-group-text" id="title">Title</span>
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="Subject" aria-label="title" aria-describedby="title">
                                                    </div>
                                            </div>
                                            <div class="row mb-3">
<!---------------------------------------------- MESSAGE CONTENT INPUT ---------------------------------------------->
                                                        <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Content" name="content" id="content" style="min-height: 450px; max-height:500px; background-color: var(--sidebar-color); color: var(--text-color);" ></textarea>
                                                        </div>
                                            </div>
                                            <div class="row">
<!---------------------------------------------- SUBMIT INPUT ---------------------------------------------->
                                                        <div class="col-sm-8"></div>
                                                        <div class="col-sm-4"><button class="btn btn-primary h-100 w-100" type="submit" id="submit" onclick="">SAVE </button></div>                                                 
                                                        
                                            </div>
                                        </form>
                                    </div>
                            </div>
                    </div>

                    <div class="col-sm-4 mb-4">
                                <div class="card w-100 h-100" style="width: 18rem;">
                                        <div class="card-body w-100 h-100">
                                                <div class="row">
                                                        <div class="row">                
                                                                <div class="col-sm-5">Notes <i class="bi bi-clipboard2-check"></i></div>

                                                                <div class="col-sm-7">
<!---------------------------------------------- SORT SELECT OPTION ---------------------------------------------->
                                                                        <select class="form-select" id="sel" name="sel">
                                                                                <option selected>SORT</option>
                                                                                <option <?php if($_SESSION['val']=="new") echo "selected" ;?> value="new">Newest</option>
                                                                                <option <?php if($_SESSION['val']=="old") echo "selected" ;?> value="old">Oldest</option>
                                                                                <option <?php if($_SESSION['val']=="fav") echo "selected" ;?> value="fav">Favorites</option>
                                                                        </select>
                                                                </div>
                                                        </div>


                                                        <div class="container" id="data" style="overflow-y:auto; overflow-x:hidden; padding-right:15px; padding-left:15px; min-height: auto; max-height: 580px;"></div>
                                                </div>
                                    </div>
                            </div>
                    </div>
            </div>
        </div>



<!---------------------------------------------- VIEW MODAL HTML ---------------------------------------------->
                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="viewModal"><?php echo stripslashes($title); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <?php echo stripslashes($content); ?>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                </div>
                        </div>
                </div>
    </section>

<!---------------------------------------------- FORM VALIDATION SCRIPT ---------------------------------------------->
    <script>
        function validateForm() {
        let title = document.forms["notes"]["title"].value;
        let content = document.forms["notes"]["content"].value;
  
        if((title == "") && (content == "")){
                Swal.fire('Input Error!', 'The <a style="color: red">title</a> and <a style="color: red">content</a> input is missing.','error')
                return false;
                }
        if ((title == "") && (content != "")){
                Swal.fire('Title Error!', 'The <a style="color: red;">title </a>input is missing.','error')
                return false;
         }
        if ((content == "") && (title != "")) {
                Swal.fire('Message Error!', 'The <a style="color: red">message input</a> is missing.','error')
                return false;
                }
                if ((content != "") && (title != "")) {
                return true;
                }
        }
    </script>
<!---------------------------------------------- LOCALLY STORED SCRIPTS ---------------------------------------------->
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/tata.js"></script>

<!---------------------------------------------- AJAX SIDE SERVER TO FETCH ALL DATA FROM --displaynotes.php ---------------------------------------------->
    <script>
        $('document').ready(function () {
    setInterval(function () {getRealData()}, 1000);//request every x seconds
    }); 
               $(document).ready(function () {
                        $.ajax({
                           type: "GET",
                           url: "--displaynotes.php",
                           dataType: "html",
                           success: function (data) {
                           $("#data").html(data);
                        }
                        });
                });
               
                setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
                        $('#data').load("--displaynotes.php").fadeIn("slow");
                }, 1000);
    </script>


<!---------------------------------------------- IF THE URL TARGET HAS #VARIABLE IT WILL POP UP THE NOTIFICATIONS AND MODALS ---------------------------------------------->
        <script>
                $(document).ready(function () {
                var target = document.location.hash.replace("#", "");
                if(target.length) {
                        if(target=="view"){
                                $('#viewModal').modal('show');
                        }
                                else if(target=="delete"){
                                Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: '<a style="color: white; text-decoration:none" href="notes.php?mode=deleted&id=<?php echo $_GET['id'];?>#success" >Yes, delete it!</a>'})
                        }
                                else if(target=="success"){
                                Swal.fire('Delete Success!','The record was deleted!','success')
                        }
                }});
        </script>

<!---------------------------------------------- AJAX SIDE SERVER OF SORT OPTION, IT THROWS THE DATA OF SELECTION TO THROW IN --displaynotes.php  ---------------------------------------------->
        <script type="text/javascript">
                $(document).ready(function(){
                    $(document).on("change","#sel",function(){
                        var val = $(this).val();
                        console.log(val);
                        $.ajax({
                            type: 'post',
                            url: '--displaynotes.php?action=data',
                            datatype:'json',
                            data: {"option":val},
                            success: function (response) {
                            }
                        });
                    });

                });
            </script>
        

</body>
</html>
